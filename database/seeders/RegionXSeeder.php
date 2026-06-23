<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class RegionXSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $townsApiUrl     = "https://psgc.gitlab.io/api/regions/100000000/cities-municipalities.json";
        $barangaysApiUrl = "https://psgc.gitlab.io/api/regions/100000000/barangays.json";

        $provincePrefixes = [
            '1013' => 'Bukidnon',
            '1018' => 'Camiguin',
            '1035' => 'Lanao del Norte',
            '1042' => 'Misamis Occidental',
            '1043' => 'Misamis Oriental',
        ];

        $hucCities = [
            'cagayan de oro city' => 'Misamis Oriental',
            'iligan city'         => 'Lanao del Norte',
        ];

        // ==========================================
        // PHASE 1: POPULATE ALL TOWNS
        // ==========================================
        $this->command->info('Fetching all official cities and municipalities for Region 10...');
        $townsResponse = Http::timeout(60)->get($townsApiUrl);

        if ($townsResponse->failed()) {
            $this->command->error('Failed to download the municipal registry.');
            return;
        }

        $rawTowns = $townsResponse->json();
        $townCache = []; // Maps Municipality PSGC Code -> Database ID

        foreach ($rawTowns as $rawTown) {
            $townName = ucwords(strtolower($rawTown['name'] ?? ''));
            $townKey  = strtolower($townName);
            $townCode = $rawTown['code'] ?? ''; // e.g., "104215000"

            $provinceName = 'Northern Mindanao';
            if (array_key_exists($townKey, $hucCities)) {
                $provinceName = $hucCities[$townKey];
            } else {
                $codePrefix = substr($townCode, 0, 4);
                if (array_key_exists($codePrefix, $provincePrefixes)) {
                    $provinceName = $provincePrefixes[$codePrefix];
                }
            }

            DB::table('towns')->insertOrIgnore([
                'town'       => $townName,
                'province'   => $provinceName,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            $townId = DB::table('towns')
                ->where('town', $townName)
                ->where('province', $provinceName)
                ->value('id');

            // Cache using the official PSGC Code instead of the string name
            if ($townCode) {
                $townCache[$townCode] = $townId;
            }
        }

        $this->command->info("Successfully populated " . count($townCache) . " towns.");

        // ==========================================
        // PHASE 2: POPULATE BARANGAYS
        // ==========================================
        $this->command->info('Downloading all regional barangays...');
        $barangaysResponse = Http::timeout(90)->get($barangaysApiUrl);

        if ($barangaysResponse->failed()) {
            $this->command->error('Failed to download the barangay data registry.');
            return;
        }

        $rawBarangays = $barangaysResponse->json();
        $barangayRecords = [];
        $totalBarangays = 0;

        foreach ($rawBarangays as $bg) {
            // The PSGC API links them dynamically via codes
            $barangayCode = $bg['code'] ?? '';
            $parentTownCode = $bg['cityMunicipalityCode'] ?? $bg['municipalityCode'] ?? $bg['cityCode'] ?? '';

            // Fallback: If the API didn't provide a direct parent code property, extract the first 6 digits
            if (empty($parentTownCode) && strlen($barangayCode) >= 6) {
                $parentTownCode = substr($barangayCode, 0, 6) . '000';
            }

            // Look up the database ID using the code from our cache
            $associatedTownId = $townCache[$parentTownCode] ?? null;

            // If it still can't find it, track down by name string as an absolute backup layout
            if (!$associatedTownId) {
                $parentTownName = ucwords(strtolower($bg['cityName'] ?? $bg['municipalityName'] ?? ''));
                $townIdByName = DB::table('towns')->where('town', $parentTownName)->value('id');
                if ($townIdByName) {
                    $associatedTownId = $townIdByName;
                    $townCache[$parentTownCode] = $associatedTownId; // Cache it for next iterations
                } else {
                    continue; // Skip if no connection can be made safely
                }
            }

            $barangayName = ucwords(strtolower($bg['name'] ?? ''));

            $barangayRecords[] = [
                'town_id'    => $associatedTownId,
                'barangay'   => $barangayName,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (count($barangayRecords) >= 200) {
                DB::table('barangays')->insert($barangayRecords);
                $totalBarangays += count($barangayRecords);
                $barangayRecords = [];
            }
        }

        if (!empty($barangayRecords)) {
            DB::table('barangays')->insert($barangayRecords);
            $totalBarangays += count($barangayRecords);
        }

        $this->command->info("Complete! Populated " . DB::table('towns')->count() . " Towns and linked {$totalBarangays} Barangays successfully.");
    }
}
