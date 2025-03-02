<div class="p-6 relative" x-data="{ showFilters: false }">
    <!-- Search Input -->
    <div class="max-w-4xl mx-auto mb-4 relative">
        
        <div class="flex w-full justify-between">
            <!-- Filter Button -->
            <button @click="showFilters = !showFilters"
                class="bg-gray-700 text-white px-4 py-2 rounded-l">
                Filters
            </button>
    
            <!-- Filters Dropdown -->
            <div x-show="showFilters" @click.away="showFilters = false"
                x-transition
                class="absolute mt-2 bg-white shadow-lg border rounded p-4 w-72 z-60">
                <h3 class="text-lg font-semibold mb-2">Filters</h3>
    
                <!-- Category Filter -->
                <label class="block mb-2">
                    Category:
                    <select wire:model="category" class="p-2 border rounded w-full">
                        <option value="">All Categories</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </label>
    
                <!-- Price Filters -->
                <label class="block mb-2">
                    Min Price:
                    <input type="number" wire:model="minPrice" class="p-2 border rounded w-full">
                </label>
    
                <label class="block mb-2">
                    Max Price:
                    <input type="number" wire:model="maxPrice" class="p-2 border rounded w-full">
                </label>
    
                <!-- Apply Filters Button -->
                <button wire:click="searchProductsDropDown" wire:click="showFilters = false"
                    class="bg-blue-500 text-white px-4 py-2 rounded w-full mt-2">
                    Apply Filters
                </button>
            </div>

            <!-- Search Form -->
            <form wire:submit.prevent
                class="grow"
            >
                <div class="flex">
                    <input type="text" wire:model.live.debounce.300ms="search"
                        placeholder="Search for products..."
                        class="w-full p-2 border"
                        autocomplete="off">
                    <button wire:click="triggerSearch"
                        class="bg-blue-500 text-white px-3 py-1 rounded-r-lg">
                        Search
                    </button>
                </div>
            </form>
        </div>

        <!-- Search Dropdown -->
        @if(!empty($dropDownResults))
        <div class="absolute w-full bg-white border rounded shadow-lg mt-1 z-50">
            @foreach($dropDownResults as $product)
            <div class="p-2 hover:bg-gray-100 cursor-pointer flex justify-between">
                <span>{{ $product->name }}</span>
                <span class="text-gray-600">${{ number_format($product->price, 2) }}</span>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    @if($searchResultsPaginated)
    <h3 class='text-xl sm:text-2xl mb-4'>Search results</h3>
    <div class='grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-10 items-center'>
        @foreach($searchResultsPaginated as $product)
        <x-product-card :product="$product" />
        @endforeach
    </div>
    <!-- Pagination Links -->
    <div class="mt-4">
        {{ $searchResultsPaginated->links() }}
    </div>
    @endif
</div>
