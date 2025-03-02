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
        <main class="bg-gray-100 flex-1 overflow-hidden">

           
            <section class="flex h-full">
                <!-- Dashboard side bar -->
                <aside class="">
                    <div class="h-full bg-gray-900 text-white w-64 flex flex-col">
                        <div class="p-4 text-xl font-bold border-b border-gray-700">
                            Dashboard
                        </div>

                        <nav class="flex-1 p-4 space-y-2">
                            <ul>
                                <li>
                                    <a href="/admin/dashboard/profile" class="block px-4 py-2 rounded hover:bg-gray-700">
                                        Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="/admin/dashboard/product/create" class="block px-4 py-2 rounded hover:bg-gray-700">
                                        Add Product
                                    </a>
                                </li>
                                <li>
                                    <a href="/admin/dashboard/categories" class="block px-4 py-2 rounded hover:bg-gray-700">
                                        Categories
                                    </a>
                                </li>
                            </ul>

                        </nav>

                        <form action="{{ route('admin.logout') }}" method="POST" class="p-4">
                            @csrf
                            <button type="submit" class="w-full px-4 py-2 text-left bg-red-600 rounded hover:bg-red-700">
                                 Logout
                            </button>
                        </form>
                    </div>

                </aside>
                <div class="h-full w-full">
                    @yield('content')
                </div>
            </section>
        </main>
    </div>
    @livewireScripts
</body>

</html>