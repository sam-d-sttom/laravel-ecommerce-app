@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="flex min-h-screen items-center justify-center bg-gray-100">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login</h2>

        @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded-md mb-4">
            {{ session('error') }}
        </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <!-- Email Field -->
            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Email:</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('email')
                <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Password:</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('password')
                <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="mb-4 flex items-center">
                <input type="checkbox" name="remember" id="remember" class="mr-2">
                <label for="remember" class="text-gray-600 text-sm">Remember Me</label>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition">
                Login
            </button>

            <!-- Register -->
            <div class="text-center mt-4">
                <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Create an account</a>
            </div>
        </form>
    </div>
</div>
@endsection