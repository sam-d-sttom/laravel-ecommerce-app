<section class="flex flex-col justify-between h-full w-full">
    <div class="overflow-y-scroll px-6 grow"">
<div class=" max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg">
        <!-- Order Header -->
        <div class="mb-6 border-b pb-4">
            <h2 class="text-2xl font-semibold">Order #{{ $order->id }}</h2>
            <p class="text-gray-600">Placed on {{ $order->created_at->format('F j, Y') }}</p>
            <span class="px-3 py-1 rounded text-white text-sm {{ $order->order_status === 'pending' ? 'bg-yellow-500' : 'bg-green-500' }}">
                {{ ucfirst($order->order_status) }}
            </span>
        </div>

        <!-- Customer Info -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold">Shipping Details</h3>
            <p><strong>Name:</strong> {{ $order->name }}</p>
            <p><strong>Email:</strong> {{ $order->email }}</p>
            <p><strong>Address:</strong> {{ $order->address }}</p>
        </div>

        <!-- Order Items -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-2">Ordered Products</h3>
            <div class="border rounded p-4 overflow-x-auto">
                <table class="w-full border-collapse min-w-[600px] md:min-w-0">
                    <thead>
                        <tr class="border-b bg-gray-100">
                            <th class="px-4 py-3 text-left">Product</th>
                            <th class="px-4 py-3 text-center">Quantity</th>
                            <th class="px-4 py-3 text-center">Price</th>
                            <th class="px-4 py-3 text-center">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderItems as $item)
                        <tr class="border-b">
                            <td class="px-4 py-3 text-left">{{ $item->product->name }}</td>
                            <td class="px-4 py-3 text-center">{{ $item->quantity }}</td>
                            <td class="px-4 py-3 text-center">${{ number_format($item->product->price, 2) }}</td>
                            <td class="px-4 py-3 text-center">${{ number_format($item->quantity * $item->product->price, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <!-- Payment Summary -->
        <div class="mb-6 border-t pt-4">
            <h3 class="text-lg font-semibold">Payment Details</h3>
            <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
            <p class="text-xl font-bold mt-2">Total: ${{ number_format($order->total_amount, 2) }}</p>
        </div>
    </div>
    </div>
</section>