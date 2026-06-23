<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class MissOccSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $townsApiUrl     = "https://psgc.gitlab.io/api/regions/100000000/cities-municipalities.json";
        $barangaysApiUrl = "https://psgc.gitlab.io/api/regions/100000000/barangays.json";

        // The unique PSGC code prefix for Misamis Occidental
        $misOccPrefix = '1042';
        $provinceName = 'Misamis Occidental';

        // ==========================================
        // PHASE 1: POPULATE MISAMIS OCCIDENTAL TOWNS
        // ==========================================
        $this->command->info('Fetching cities and municipalities for Misamis Occidental...');
        $townsResponse = Http::timeout(60)->get($townsApiUrl);

        if ($townsResponse->failed()) {
            $this->command->error('Failed to download the municipal registry.');
            return;
        }

        $rawTowns = $townsResponse->json();
        $townCache = []; // Maps Municipality PSGC Code -> Database ID

        foreach ($rawTowns as $rawTown) {
            $townCode = $rawTown['code'] ?? ''; // e.g., "104215000"
            $codePrefix = substr($townCode, 0, 4);

            // CRITICAL FILTER: Skip if the town does not belong to Misamis Occidental (1042)
            if ($codePrefix !== $misOccPrefix) {
                continue;
            }

            $townName = ucwords(strtolower($rawTown['name'] ?? ''));

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

            if ($townCode) {
                $townCache[$townCode] = $townId;
            }
        }

        $this->command->info("Successfully populated " . count($townCache) . " towns/cities for Misamis Occidental.");

        // ==========================================
        // PHASE 2: POPULATE BARANGAYS FOR MISAMIS OCCIDENTAL
        // ==========================================
        $this->command->info('Downloading regional barangays and filtering for Misamis Occidental...');
        $barangaysResponse = Http::timeout(90)->get($barangaysApiUrl);

        if ($barangaysResponse->failed()) {
            $this->command->error('Failed to download the barangay data registry.');
            return;
        }

        $rawBarangays = $barangaysResponse->json();
        $barangayRecords = [];
        $totalBarangays = 0;

        foreach ($rawBarangays as $bg) {
            $barangayCode = $bg['code'] ?? '';
            $parentTownCode = $bg['cityMunicipalityCode'] ?? $bg['municipalityCode'] ?? $bg['cityCode'] ?? '';

            if (empty($parentTownCode) && strlen($barangayCode) >= 6) {
                $parentTownCode = substr($barangayCode, 0, 6) . '000';
            }

            // CRITICAL FILTER: Look up the town cache.
            // If the code isn't in our cache, it means it belongs to another province, so we skip it!
            $associatedTownId = $townCache[$parentTownCode] ?? null;

            if (!$associatedTownId) {
                continue;
            }

            $barangayName = ucwords(strtolower($bg['name'] ?? ''));

            $barangayRecords[] = [
                'town_id'    => $associatedTownId,
                'barangay'   => $barangayName,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Batch insert in chunks of 100 for safety
            if (count($barangayRecords) >= 100) {
                DB::table('barangays')->insert($barangayRecords);
                $totalBarangays += count($barangayRecords);
                $barangayRecords = [];
            }
        }

        // Insert remaining rows
        if (!empty($barangayRecords)) {
            DB::table('barangays')->insert($barangayRecords);
            $totalBarangays += count($barangayRecords);
        }

        $this->command->info("Complete! Populated Misamis Occidental with " . count($townCache) . " Towns/Cities and linked {$totalBarangays} Barangays successfully.");
    }
}
