<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400..700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles        

        <script>
            if (localStorage.getItem('dark-mode') === 'false' || !('dark-mode' in localStorage)) {
                document.querySelector('html').classList.remove('dark');
                document.querySelector('html').style.colorScheme = 'light';
            } else {
                document.querySelector('html').classList.add('dark');
                document.querySelector('html').style.colorScheme = 'dark';
            }
        </script>
    </head>
    <body
        class="font-inter antialiased bg-gray-100 dark:bg-gray-900 text-gray-600 dark:text-gray-400"
        :class="{ 'sidebar-expanded': sidebarExpanded }"
        x-data="{ sidebarOpen: false, sidebarExpanded: localStorage.getItem('sidebar-expanded') == 'true' }"
        x-init="$watch('sidebarExpanded', value => localStorage.setItem('sidebar-expanded', value))"    
    >

        <script>
            if (localStorage.getItem('sidebar-expanded') == 'true') {
                document.querySelector('body').classList.add('sidebar-expanded');
            } else {
                document.querySelector('body').classList.remove('sidebar-expanded');
            }
        </script>

        <!-- Page wrapper -->
        <div class="flex h-[100dvh] overflow-hidden">

            <x-app.sidebar :variant="$attributes['sidebarVariant']" />

            <!-- Content area -->
            <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden @if($attributes['background']){{ $attributes['background'] }}@endif" x-ref="contentarea">

                <x-app.header :variant="$attributes['headerVariant']" />

                <main class="grow">
                    {{ $slot }}
                </main>

            </div>

        </div>

        @livewireScriptConfig
        @if(session('success')) 
            <div id="success-toast" class="fixed bottom-4 right-4 bg-green-500 text-white dark:bg-green-700 dark:text-gray-200 px-6 py-3 rounded-lg shadow-xl flex items-center space-x-3 animate-fade-in">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white dark:text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2l4-4m6 2a9 9 0 11-18 0a9 9 0 0118 0z" />
            </svg>
            <span>{{ session('success') }}</span>
            </div>
            <script>
            setTimeout(() => {
                const successToast = document.getElementById('success-toast');
                if (successToast) {
                successToast.style.transition = 'opacity 0.5s ease-out';
                successToast.style.opacity = '0';
                setTimeout(() => successToast.remove(), 500);
                }
            }, 5000); // 5 seconds
            </script>
        @endif

        @if(session('error')) 
            <div id="error-toast" class="fixed bottom-4 right-4 bg-red-500 text-white dark:bg-red-700 dark:text-gray-200 px-6 py-3 rounded-lg shadow-xl flex items-center space-x-3 animate-fade-in">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white dark:text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
            <span>{{ session('error') }}</span>
            </div>
            <script>
            setTimeout(() => {
                const errorToast = document.getElementById('error-toast');
                if (errorToast) {
                errorToast.style.transition = 'opacity 0.5s ease-out';
                errorToast.style.opacity = '0';
                setTimeout(() => errorToast.remove(), 500);
                }
            }, 5000); // 5 seconds
            </script>
        @endif

        <style>
            @keyframes fade-in {
            from {
            opacity: 0;
            transform: translateY(10px);
            }
            to {
            opacity: 1;
            transform: translateY(0);
            }
            }
            .animate-fade-in {
            animation: fade-in 0.3s ease-out;
            }
        </style>
    </body>
</html>
