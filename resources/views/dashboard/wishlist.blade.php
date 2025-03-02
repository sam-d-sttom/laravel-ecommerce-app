@extends('layouts.dashboard')

@section('title', 'Your Wishlist')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="">
        <h1 class="text-2xl font-bold mb-4">Your Wishlist</h1>
    </div>

    <div class="overfllow-y-scroll">
        @livewire('wishlist-component')
    </div>

</div>
@endsection