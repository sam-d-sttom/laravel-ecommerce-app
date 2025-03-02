<section class="flex flex-col justify-between h-full w-full">
    <div class="overflow-y-scroll px-6 grow"">
    @if(session()->has('success'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)"
        x-show="show"
        class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif
    <div class="flex flex-col md:flex-row justify-between mb-4">
        <!-- Search Input -->
        <div class="relative w-full md:w-1/3 mb-2 md:mb-0">
            <input type="text" placeholder="Search orders..." class="border p-2 rounded w-full">
        </div>

        <!-- Status Filter -->
        <select class="border p-2 rounded w-full md:w-1/4">
            <option value="">All Status</option>
            <option value="pending">Pending</option>
            <option value="processing">Processing</option>
            <option value="completed">Completed</option>
            <option value="canceled">Canceled</option>
        </select>
    </div>

    <!-- Pagination -->
    <div class="flex justify-between my-4">
        <button class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Previous</button>
        <button class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Next</button>
    </div>

    <!-- Orders Table -->
    <div class="overflow-x-auto">
        <table class="w-full border-collapse border bg-white">
            <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="p-3 text-left border">Order ID</th>
                    <th class="p-3 text-left border">Customer</th>
                    <th class="p-3 text-left border">Status</th>
                    <th class="p-3 text-left border">Total</th>
                    <th class="p-3 text-left border">Date</th>
                    <th class="p-3 text-left border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr class="border-b">
                    <td class="p-3 border">#{{ $order->id }}</td>
                    <td class="p-3 border">{{ $order->name }}</td>
                    <td class="p-3 border"><span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded">{{ $order->order_status }}</span></td>
                    <td class="p-3 border">${{ number_format($order->total_amount, 2) }}</td>
                    <td class="p-3 border">{{ $order->created_at->format('Y-m-d') }}</td>
                    <td class="p-3 border">
                        <a href="/dashboard/orders/{{ $order->id }}" >
                            <button class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">View</button>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="flex justify-between mt-4">
        <button class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Previous</button>
        <button class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Next</button>
    </div>
</div>
</section>