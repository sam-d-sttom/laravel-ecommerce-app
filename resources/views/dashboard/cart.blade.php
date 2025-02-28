@extends('layouts.dashboard')

@section('title', 'Cart')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Your Cart</h1>

    @if($wishlistItems->isEmpty())
    <p class="text-gray-500">Your cart is empty.</p>
    @else
    @livewire('cart')
    @endif
</div>
@endsection