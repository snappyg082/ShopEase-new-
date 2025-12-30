<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'ShopEase') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
     
    {{-- -navigation links after closing of header --}}
    
</head>

 @include('layouts.navigation')
</nav>

<body>
    {{-- GLOBAL BACKGROUND --}}
    <div class="min-h-screen bg-cover bg-center bg-fixed"
       style="background-image: url({{ asset('images/mainBackground.png') }})"
        {{-- Header --}}
        <header class="bg-white/80 backdrop-blur shadow">
            <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
                @yield('header')
            </div>
        </header>

        {{-- Page Content --}}
        <main class="py-10">
            @yield('content')
        </main>

    </div>
     
</body>

</html>