<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <title>@yield('title', 'Ecommerce')</title>
</head>

<body>
    <x-header title="ECOMMERCE" />
    @php
    // Get user based on the guard
    $user = Auth::guard('admin')->check() ? Auth::guard('admin')->user() : Auth::guard('web')->user();
    @endphp

    @if($user)
    <!-- <p>Welcome, {{ $user->role === 'admin' ? 'Admin' : 'User' }} {{ $user->name }}!</p>
    <p>Email: {{ $user->email }}</p> -->
    <section class="flex h-screen pt-[12vh]">
        <!-- Dashboard side bar -->
        <aside class="">
            <div class="h-full bg-gray-900 text-white w-64 flex flex-col">
                <div class="p-4 text-xl font-bold border-b border-gray-700">
                    Dashboard
                </div>

                <nav class="flex-1 p-4 space-y-2">
                    <!-- for admin -->
                    @if($user->role === 'admin')
                    <ul>
                    <li>
                            <a href="/product/update" class="block px-4 py-2 rounded hover:bg-gray-700">
                                Profile
                            </a>
                        </li>
                        <li>
                            <a href="/product/create" class="block px-4 py-2 rounded hover:bg-gray-700">
                                Add Product
                            </a>
                        </li>
                        <li>
                            <a href="/product/update" class="block px-4 py-2 rounded hover:bg-gray-700">
                                Edit Product
                            </a>
                        </li>
                        <li>
                            <a href="/product/update" class="block px-4 py-2 rounded hover:bg-gray-700">
                                All Products
                            </a>
                        </li>
                        <li>
                            <a href="/user/update" class="block px-4 py-2 rounded hover:bg-gray-700">
                                Edit User
                            </a>
                        </li>
                    </ul>

                    @endif

                    <!-- for user -->
                    @if($user->role === 'user')
                    <ul>
                        <li>
                            <a href="/product/update" class="block px-4 py-2 rounded hover:bg-gray-700">
                                Profile
                            </a>
                        </li>
                        <li>
                            <a href="/product/create" class="block px-4 py-2 rounded hover:bg-gray-700">
                                Wishlist
                            </a>
                        </li>
                        <li>
                            <a href="/product/update" class="block px-4 py-2 rounded hover:bg-gray-700">
                                Orders
                            </a>
                        </li>
                        <li>
                            <a href="/user/update" class="block px-4 py-2 rounded hover:bg-gray-700">
                                Settings
                            </a>
                        </li>
                    </ul>

                    @endif

                </nav>

                <form action="{{ route('logout') }}" method="POST" class="p-4">
                    @csrf
                    <button type="submit" class="w-full px-4 py-2 text-left bg-red-600 rounded hover:bg-red-700">
                        🚪 Logout
                    </button>
                </form>
            </div>

        </aside>
        <div class="p-[20px]">
            @yield('content')
        </div>
    </section>
    @endif
</body>

</html>