{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} | Career Opportunities and Recommendation Engine.</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen from-blue-50 to-indigo-100 bg-gradient-to-r dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html> --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} | Career Opportunities and Recommendation Engine.</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen from-blue-50 to-indigo-100 bg-gradient-to-r dark:bg-gray-900 flex flex-col">

            @include('layouts.navigation')

            <div class="flex flex-1">

                @if(Auth::check() && Auth::user()->usertype === 'admin')
                    <aside class="w-64 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 flex flex-col shrink-0">
                        <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                            <span class="text-lg font-bold text-gray-900 dark:text-gray-100 tracking-tight">JRS Admin Panel</span>
                        </div>

                        <nav class="flex-1 p-4 space-y-1">
                            <a href="#" class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                Dashboard
                            </a>
                            <a href="{{ route('adtv_listUsers') }}" class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                Users Management
                            </a>
                            <a href="{{ route('adtv_storeEmployer') }}" class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                Employers Management
                            </a>
                            <a href="{{ route('listJobs') }}" class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                Job List
                            </a>
                        </nav>

                        <div class="p-4 border-t border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-900/50">
                            <p class="text-xs font-semibold text-gray-900 dark:text-gray-100">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] text-gray-500 font-mono">ID: {{ Auth::user()->idno }}</p>
                        </div>
                    </aside>
                @endif
                @if(Auth::check() && Auth::user()->usertype === 'employer')
                    <aside class="w-64 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 flex flex-col shrink-0">
                        <div class="p-6 border-b border-purple-50 dark:border-gray-700 bg-purple-50/40 dark:bg-gray-800/50">
                            <span class="text-lg font-bold text-purple-900 dark:text-purple-400 tracking-tight">Employer Console</span>
                        </div>

                        <nav class="flex-1 p-4 space-y-1">
                            <a href="#" class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-600 dark:text-gray-300 rounded-lg hover:bg-purple-50 hover:text-purple-700 dark:hover:bg-gray-700 transition-colors group">
                                <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-purple-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                </svg>
                                Dashboard
                            </a>

                            <a href="#" class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-600 dark:text-gray-300 rounded-lg hover:bg-purple-50 hover:text-purple-700 dark:hover:bg-gray-700 transition-colors group">
                                <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-purple-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Post Job
                            </a>

                            <a href="#" class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-600 dark:text-gray-300 rounded-lg hover:bg-purple-50 hover:text-purple-700 dark:hover:bg-gray-700 transition-colors group">
                                <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-purple-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h18v3H3V3z" />
                                </svg>
                                Company
                            </a>
                        </nav>

                        <div class="p-4 border-t border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-900/50">
                            <p class="text-xs font-semibold text-purple-900 dark:text-purple-400">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] text-gray-500 font-mono">ID: {{ Auth::user()->idno }}</p>
                        </div>
                    </aside>
                @endif
                <div class="flex-1 flex flex-col">
                    @isset($header)
                        <header class="bg-white dark:bg-gray-800 shadow">
                            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                                {{ $header }}
                            </div>
                        </header>
                    @endisset

                    <main class="p-6 flex-1">
                        {{ $slot }}
                    </main>
                </div>

            </div>
        </div>
    </body>
</html>
