<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
        <div id="app" x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto">
            @include('layouts.sidebar')

            <div class="flex-1 flex flex-col overflow-hidden">
                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200 relative">
                    <form action="{{ route('logout') }}" method="POST" class="absolute top-0 right-0 left-auto mt-12 mr-10">
                        {{ csrf_field() }}
                        <button type="submit" class="inline-flex items-center text-gray-600 hover:text-gray-900 transition duration-200 ease-in-out">
                            <svg class="w-6 h-6 fill-current" viewBox="0 0 459 459">
                                <path d="M181.05 321.3l35.7 35.7 127.5-127.5L216.75 102l-35.7 35.7 66.3 66.3H0v51h247.35l-66.3 66.3zM408 0H51C22.95 0 0 22.95 0 51v102h51V51h357v357H51V306H0v102c0 28.05 22.95 51 51 51h357c28.05 0 51-22.95 51-51V51c0-28.05-22.95-51-51-51z"/>
                            </svg>
                            <span class="font-semibold ml-1">Выход</span>
                        </button>
                    </form>
                    <div class="container mx-auto px-6 py-8">
                        @yield('content')
                    </div>
                </main>
            </div>
        </div>
</body>
</html>
