@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-2">
            <!-- Product Image -->
            <div>
                <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8c2hvZXN8ZW58MHx8MHx8fDA%3D"
                    alt="{{ $product->name }}"
                    class="w-full h-96 object-cover">
            </div>

            <!-- Product Details -->
            <div class="p-6 relative">
                <h1 class="text-2xl font-bold text-gray-900">{{ $product->name }}</h1>
                <p class="text-gray-600 mt-2">{{ $product->description }}</p>

                <div class="flex items-center justify-between mt-4">
                    <span class="text-lg font-semibold text-gray-900">${{ number_format($product->price, 2) }}</span>

                    <!-- Wishlist Button -->
                    <button
                        x-data="{ liked: false }"
                        @click="liked = !liked"
                        class="focus:outline-none">
                        <svg
                            :class="liked ? 'fill-red-600' : 'fill-white'"
                            class="w-8 h-8 transition duration-300 cursor-pointer"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24">
                            <path
                                d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"
                                stroke="currentColor"
                                stroke-width="0.3" />
                        </svg>
                    </button>
                </div>

                <!-- Category & Subcategory -->
                <p class="text-gray-500 mt-2">
                    Category: <span class="font-semibold">{{ $product->subCategory->category->name }}</span> <br>
                    Subcategory: <span class="font-semibold">{{ $product->subCategory->name }}</span>
                </p>

                <!-- Add to Cart Button -->
                <div class="absolute bottom-2 w-[80%]">
                    <form action="" method="POST" class="mt-6">
                        @csrf
                        <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg text-lg font-semibold hover:bg-blue-700 transition">
                            🛒 Add to Cart
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Wishlist Button -->
<script>
    document.querySelector('.like-btn').addEventListener('click', function() {
        this.classList.toggle('text-red-500'); // Fills the heart when clicked
    });
</script>
@endsection