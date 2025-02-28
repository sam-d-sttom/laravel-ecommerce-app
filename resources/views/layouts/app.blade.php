<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
    <title>@yield('title', 'Ecommerce')</title>
</head>

<body>
    <div class="flex flex-col h-screen">
        <x-header title="ECOMMERCE" />
        <main class="bg-gray-100 grow overflow-y-scroll px-[3vw] pt-[40px]">
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/wishlist.js') }}"></script>
    @livewireScripts
</body>

</html>