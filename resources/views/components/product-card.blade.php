<div class="max-w-sm bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
    <img class="w-full h-48 object-cover" src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8c2hvZXN8ZW58MHx8MHx8fDA%3D" alt="Product Image">
    <div class="p-4">

        <div class="flex justify-between">
            <h2 class="text-lg font-semibold text-gray-900">{{ $product->name }}</h2>
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
        <p class="text-gray-600 text-sm mt-1">{{ $product->description }}</p>
        <div class="flex justify-between items-center mt-4">
            <span class="text-xl font-bold text-indigo-600">${{ $product->price }}</span>
            <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition cursor-pointer">
                View
            </button>
        </div>
    </div>
</div>