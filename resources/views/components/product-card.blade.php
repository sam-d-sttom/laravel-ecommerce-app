<div class="max-w-sm sm:max-w-md md:max-w-lg lg:max-w-xl w-full bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">

    <img class="w-full h-48 sm:h-56 md:h-64 lg:h-72 object-cover"
        src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8c2hvZXN8ZW58MHx8MHx8fDA%3D"
        alt="{{ $product->name }}">


    <div class="p-4">
        <div class="flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-900 truncate">{{ $product->name }}</h2>
            <x-wishlist-button :productId="$product->id" :isWishlisted="$product->is_wishlisted" />
        </div>

        <p class="text-gray-600 text-sm mt-1 line-clamp-2">{{ substr($product->description, 0, 50) }}</p>


        <div class="flex flex-col justify-between mt-4">
            <span class="text-xl font-bold text-indigo-600">${{ number_format($product->price, 2) }}</span>
            <a href="/product/{{ $product->id }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition cursor-pointer">
                <button class="text-center w-full" >
                    View
                </button>
            </a>
        </div>
    </div>
</div>