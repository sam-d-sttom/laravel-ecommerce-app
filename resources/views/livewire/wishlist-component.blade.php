<div class="wishlists-div grid grid-cols-1 md:grid-cols-3 gap-6">
    @foreach($wishlistItems as $item)
    <div class="bg-white shadow-lg rounded-lg p-4">
        <img src="{{ asset($item->product->image ?? 'images/default-product.jpg') }}" class="w-full h-40 object-cover">
        <h2 class="text-lg font-semibold mt-2">{{ $item->product->name }}</h2>
        <p class="text-gray-600">${{ number_format($item->product->price, 2) }}</p>

        <button 
            wire:click="removeFromWishlist({{ $item->id }})"
            class="remove-wishlist-btn w-full bg-blue-600 text-white px-4 py-2 rounded-lg text-lg font-semibold hover:bg-blue-700 transition">
            Remove
        </button>
    </div>
    @endforeach
</div>
