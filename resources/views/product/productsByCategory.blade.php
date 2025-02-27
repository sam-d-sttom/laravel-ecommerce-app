@extends('layouts.app')

@section('title', 'Ecommerce | Products')

@section('content')

<section>
    <h3 class="text-3xl mb-10">{{ strtoupper($category_name )}}</h3>
    <div class="grid grid-cols-4 gap-10">
        @foreach ($products as $product)
            <x-product-card :product="$product" />
        @endforeach
    </div>
</section>

@endsection