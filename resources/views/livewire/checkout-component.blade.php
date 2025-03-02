<section class="flex flex-col justify-between h-full w-full">
    <div class="overflow-y-scroll px-6 grow"">
        
        <form wire:submit.prevent="placeOrder" class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg">
        
            <!-- Billing Details -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-2">Billing Details</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <input type="text" wire:model="name" placeholder="Full Name" class="border p-2 rounded w-full" required>
                    <input type="email" wire:model="email" placeholder="Email Address" class="border p-2 rounded w-full" required>
                    <input type="text" wire:model="phone" placeholder="Phone Number" class="border p-2 rounded w-full" required>
                    <input type="text" wire:model="address" placeholder="Shipping Address" class="border p-2 rounded w-full" required>
                </div>
            </div>
        
            <!-- Order Summary -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-2">Order Summary</h3>
                <div class="border p-4 rounded">
                    <div class="grid grid-cols-3 font-semibold border-b pb-2 mb-2">
                        <span>Product</span>
                        <span class="text-center">Quantity</span>
                        <span class="text-right">Subtotal</span>
                    </div>
        
                    <!-- Dynamic Cart Items -->
                    @foreach($cartItems as $item)
                    <div class="grid grid-cols-3 py-2 border-b">
                        <span>{{ $item->product->name }}</span>
                        <span class="text-center">{{ $item->quantity }}</span>
                        <span class="text-right">${{ number_format($item->total_cost, 2) }}</span>
                    </div>
                    @endforeach
        
                    <!-- Total -->
                    <div class="grid grid-cols-3 font-semibold pt-2">
                        <span>Total</span>
                        <span></span> <!-- Empty for spacing -->
                        <span class="text-right">${{ number_format($totalAmount, 2) }}</span>
                    </div>
                </div>
            </div>
        
            <!-- Payment Options -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-2">Payment Method</h3>
                <div class="flex items-center space-x-4">
                    <label wire:click="updatePaymentMethod('cash')" class="flex items-center space-x-2">
                        <input type="radio" name="payment-method"  value="cash" class="form-radio" required>
                        <span>Cash on Delivery</span>
                    </label>
                    <label wire:click="updatePaymentMethod('card')"  class="flex items-center space-x-2">
                        <input type="radio" name="payment-method" value="card" class="form-radio" required>
                        <span>Pay with Card</span>
                    </label>
                    
                </div>
            </div>
        
            <!-- Card Details (Show only if "Pay with Card" is selected) -->
            @if($paymentMethod === 'card')
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-2">Card Details</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <input type="text" wire:model="cardNumber" placeholder="Card Number" class="border p-2 rounded w-full" required>
                    <input type="text" wire:model="cardExpiry" placeholder="MM/YY" class="border p-2 rounded w-full" required>
                    <input type="text" wire:model="cardCVC" placeholder="CVC" class="border p-2 rounded w-full" required>
                </div>
            </div>
            @endif
        
            <!-- Checkout Button -->
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded w-full font-semibold hover:bg-blue-600">
                Place Order
            </button>
        
        
        </form>
    </div>
</section>