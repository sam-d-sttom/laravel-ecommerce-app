@extends('layouts.dashboard')

@section('title', 'Your Wishlist')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Your Wishlist</h1>

    @if($wishlistItems->isEmpty())
    <p class="text-gray-500">Your wishlist is empty.</p>
    @else
    @livewire('wishlist-component')
    @endif
</div>
@endsection