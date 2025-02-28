<div class="max-w-sm bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
    <img class="w-full h-48 object-cover" src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8c2hvZXN8ZW58MHx8MHx8fDA%3D" alt="Product Image">
    <div class="p-4">

        <div class="flex justify-between">
            <h2 class="text-lg font-semibold text-gray-900">{{ $product->name }}</h2>
            <x-wishlist-button :productId="$product->id" :isWishlisted="$product->is_wishlisted"/>

        </div>
        <p class="text-gray-600 text-sm mt-1">{{ $product->description }}</p>
        <div class="flex justify-between items-center mt-4">
            <span class="text-xl font-bold text-indigo-600">${{ $product->price }}</span>
            <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition cursor-pointer">
                View
            </button>
        </div>
    </div>
</div>