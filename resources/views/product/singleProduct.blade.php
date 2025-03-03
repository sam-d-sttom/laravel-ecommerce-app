@extends('layouts.app')

@section('title', 'Ecommerce | Product')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">

        <div class="grid grid-cols-1 md:grid-cols-2">
            <!-- Product Image -->
            <div>
                <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8c2hvZXN8ZW58MHx8MHx8fDA%3D"
                    alt="{{ $product->name }}"
                    class="w-full h-72 md:h-full object-cover">
            </div>

            <!-- Product Details -->
            <div class="p-6 flex flex-col justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $product->name }}</h1>
                    <p class="text-gray-600 mt-2">{{ $product->description }}</p>

                    <!-- Price & Wishlist -->
                    <div class="flex items-center justify-between mt-4">
                        <span class="text-lg font-semibold text-gray-900">
                            ${{ number_format($product->price, 2) }}
                        </span>
                        <x-wishlist-button :isWishlisted="$product->is_wishlisted" :productId="$product->id"/>
                    </div>

                    <!-- Category & Subcategory -->
                    <p class="text-gray-500 mt-2">
                        Category: <span class="font-semibold">{{ $product->subCategory->category->name }}</span> <br>
                        Subcategory: <span class="font-semibold">{{ $product->subCategory->name }}</span>
                    </p>
                </div>

                <!-- Add to Cart Button -->
                <div class="mt-6">
                    <livewire:add-to-cart-btn-component :product="$product" />
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
