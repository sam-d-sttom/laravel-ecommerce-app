<button class="cursor-pointer relative">
    <x-heroicon-o-shopping-cart class="w-8 h-8 text-gray-500" />
    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold w-5 h-5 flex items-center justify-center rounded-full">
        {{ $cartQuantity }}
    </span>
</button>