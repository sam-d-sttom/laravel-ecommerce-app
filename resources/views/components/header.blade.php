<header class="bg-white shadow-md p-4 flex justify-between items-center z-40 fixed w-full">
    <!-- App Name / Title -->
    <a href="" class="text-xl font-bold text-gray-700">{{ $title }}</a>


    <!-- User Menu -->
    <div>
        @if($user)
        <span class="mr-4">{{ $user->name }}</span>
        <form action="{{ route('logout') }}" method="GET" class="inline">
            @csrf
            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                Logout
            </button>
        </form>
        @else
        <a href="{{ route('login') }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Login</a>
        @endif
    </div>
</header>