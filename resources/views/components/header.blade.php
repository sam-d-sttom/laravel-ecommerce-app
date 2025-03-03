<header class="bg-white shadow-md p-4 flex justify-between items-center z-40 w-full">
    <!-- App Name / Title -->
    <a href="/" class="text-xl font-bold text-gray-700">{{ $title }}</a>


    <!-- User Menu -->
    <div>
        @if($user)
        <div x-data="{ open: false }" class="flex gap-x-4">
            @if (auth()->guard('web')->check())
            <a href="{{ route('cart.index') }}">
                <livewire:cart />
            </a>
            @endif

            <button @click="open = !open" class="cursor-pointer">
                <x-heroicon-o-user-circle class="w-8 h-8 text-gray-500" />
            </button>

            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-[250px] bg-white shadow-lg rounded-lg border z-50">
                <span class="px-4 mr-4">{{ $user->name }}</span>
                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">
                    Dashboard
                </a>
                <form method="GET" action="{{ route('logout') }}" class="block">
                    @csrf
                    <button type="submit" class="cursor-pointer w-full text-left px-4 py-2 text-red-600 hover:bg-gray-200">
                        Logout
                    </button>
                </form>
            </div>
        </div>
        @else
        <a href="{{ route('login') }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Login</a>
        @endif

    </div>
</header>