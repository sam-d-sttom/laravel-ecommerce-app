<section class="mb-18">
    <div class="flex justify-between mb-6">
        <h3 class='text-xl sm:text-2xl'>{{ $title }}</h3>
        <a href="/product/category/{{ strtolower($title) }}">
            <button class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition cursor-pointer">
                View ALL
            </button>
        </a>
    </div>

    <div class='grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-4 md:gap-6 lg:gap-8 items-center'>

        @foreach ($products as $product)
        <x-product-card :product="$product" />

        @endforeach
    </div>
</section>