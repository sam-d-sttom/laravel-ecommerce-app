<section class="flex flex-col justify-between h-full w-full">
<div class="overflow-y-scroll px-10 grow">
    @if($wishlistItems->isEmpty())
        <div class="flex flex-col items-center justify-center text-center">
            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10l1.462-1.462A5.985 5.985 0 0112 6a5.985 5.985 0 017.538 2.538L21 10M7 21V10m10 11V10m-5 11v-7"></path>
            </svg>
            <p class="text-gray-500 text-lg mt-2">Your wishlist is empty.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($wishlistItems as $item)
                <div class="bg-white shadow-md rounded-xl overflow-hidden hover:shadow-lg transition duration-300">
                    <!-- Product Image -->
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8c2hvZXN8ZW58MHx8MHx8fDA%3D" class="w-full h-56 object-cover">
                        <button wire:click="removeFromWishlist({{ $item->id }})"
                            class="absolute top-2 right-2 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition">
                            &times;
                        </button>
                    </div>

                    <!-- Product Details -->
                    <div class="p-4">
                        <h2 class="text-lg font-semibold text-gray-900 truncate">{{ $item->product->name }}</h2>
                        <p class="text-gray-600 text-sm mt-1">{{ Str::limit($item->product->description, 60) }}</p>
                        
                        <div class="flex flex-col justify-between mt-4">
                            <span class="text-xl font-bold text-indigo-600">${{ number_format($item->product->price, 2) }}</span>

                            <livewire:add-to-cart-btn-component :product="$item->product" />
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
</section>