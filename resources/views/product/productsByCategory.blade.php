@extends('layouts.app')

@section('title', 'Ecommerce | Products')

@section('content')

<section>
    <h3 class="text-3xl mb-10">{{ strtoupper($category_name )}}</h3>
    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-4 md:gap-6 lg:gap-8">
        @foreach ($products as $product)
            <x-product-card :product="$product" />
        @endforeach
    </div>
</section>

@endsection