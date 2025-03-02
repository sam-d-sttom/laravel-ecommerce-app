<section class="flex flex-col justify-between h-full w-full">
    @php
    $total = 0;
    @endphp
    <div class="overflow-y-scroll px-6 grow">
        @if($cartItems->isEmpty())
        <p class="text-gray-500">Your cart is empty.</p>
        @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($cartItems as $item)
            @php
            $total += $item->total_cost;
            @endphp

            <div class="flex flex-col sm:flex-row items-center justify-between bg-white shadow-md rounded-lg w-full">
                <!-- Product Image & Details -->
                <div class="w-full sm:w-[40%] h-full sm:h-full">
                    <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8c2hvZXN8ZW58MHx8MHx8fDA%3D" alt="Product Image" class="w-full h-full object-cover rounded-l-md">

                </div>

                <!-- Quantity & Total Price -->
                <div class="flex grow flex-col sm:flex-col p-2 gap-y-2">
                    <div>
                        <h3 class="text-lg font-semibold">{{ $item->product->name }}</h3>
                        <p class="text-gray-500 text-sm">{{ $item->product->description }}</p>
                        <p class="text-gray-700 font-semibold">Price: ${{ number_format($item->product->price, 2) }}</p>
                    </div>
                    <div class="flex justify-between">
                        <div class="flex items-center gap-x-2">
                            <button
                                wire:click="decreaseCartItemQueantity({{ $item->id }}, {{ $item->product->price }})"
                                class="bg-gray-200 text-gray-700 px-2 py-1 rounded">
                                -
                            </button>
                            <span class="text-lg font-semibold">{{ $item->quantity }}</span>
                            <button
                                wire:click="increaseCartItemQueantity({{ $item->id }}, {{ $item->product->price }})"
                                class="bg-gray-200 text-gray-700 px-2 py-1 rounded">
                                +
                            </button>
                        </div>
                        <p class="text-gray-900 font-semibold">Total: ${{ number_format($item->total_cost, 2) }}</p>
                    </div>
                    <!-- Remove Button -->
                    <button
                        wire:click="removeFromCartItems({{ $item->id }}, {{ $item->quantity }})"
                        class="bg-red-500 text-white px-3 py-1 rounded-lg w-full sm:w-auto mt-4 sm:mt-0">
                        Remove
                    </button>
                </div>


            </div>

            @endforeach
        </div>
        @endif
    </div>
    <div class="flex justify-between items-center px-6 h-16">
        <p class="text-gray-900 font-semibold">Total: ${{ number_format($total, 2) }}</p>

        <a href="{{ route('checkout') }}">
            <button class="bg-blue-500 text-white px-3 py-1 rounded-lg">Checkout</button>
        </a>
    </div>
</section>