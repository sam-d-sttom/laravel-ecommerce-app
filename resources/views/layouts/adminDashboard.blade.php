<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    <title>@yield('title', 'Ecommerce')</title>
</head>

<body>
    <div class="flex flex-col h-screen">
        <x-header title="ECOMMERCE" />
        <main class="flex-1 overflow-hidden relative">
            <section class="flex h-full relative" x-data="{ open: false }">
                <!-- Mobile Toggle Button -->
                <button @click="open = true" class=" absolute top-4 left-0 bg-gray-900 text-white px-4 py-2 rounded-r-lg shadow-lg z-50 cursor-pointer">
                    ☰
                </button>

                <!-- Sidebar with Alpine.js -->
                <aside
                    x-show="open" x-transition:enter="transition transform duration-300"
                    x-transition:enter-start="-translate-x-full"
                    x-transition:enter-end="translate-x-0"
                    x-transition:leave="transition transform duration-300"
                    x-transition:leave-start="translate-x-0"
                    x-transition:leave-end="-translate-x-full"
                    class="absolute h-full bg-gray-900 text-white w-64 shadow-lg flex flex-col z-50">

                    <!-- Sidebar -->

                    <div class=" p-4 text-xl font-bold border-b border-gray-700 flex justify-between items-center">
                        Dashboard
                        <!-- Close Button for Mobile -->
                        <button @click="open = false" class="cursor-pointer bg-gray-900 text-white p-2 rounded-lg shadow-lg z-50">
                            X
                        </button>
                    </div>

                    <nav class="flex-1 p-4 space-y-2">
                        <ul>
                            <li><a href="/admin/dashboard/profile" class="block px-4 py-2 rounded hover:bg-gray-700">Profile</a></li>
                            <li><a href="/admin/dashboard/product/create" class="block px-4 py-2 rounded hover:bg-gray-700">Add Product</a></li>
                            <li><a href="/admin/dashboard/categories" class="block px-4 py-2 rounded hover:bg-gray-700">Categories</a></li>
                        </ul>
                    </nav>

                    <form action="{{ route('admin.logout') }}" method="POST" class="p-4">
                        @csrf
                        <button type="submit" class="w-full px-4 py-2 text-left bg-red-600 rounded hover:bg-red-700">
                                Logout
                        </button>
                    </form>

                    <!-- Overlay for mobile to close sidebar when clicking outside
                    <div x-show="open" @click="open = false" class="fixed inset-0 bg-black/50 md:hidden"></div> -->
                </aside>

                <!-- Main content area (does not get pushed) -->
                <div class="h-full w-full">
                    @yield('content')
                </div>
            </section>
        </main>
        
    </div>
    @livewireScripts
</body>

</html>