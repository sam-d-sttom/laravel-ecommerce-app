@extends('layouts.dashboard')

@section('title', 'Cart')

@section('content')
<div class="h-full relative flex flex-col mx-auto pt-18 w-full">
    <div class="absolute top-0 left-0 h-16 w-full flex items-center px-20">
        <h1 class="text-2xl font-bold">Checkout</h1>
    </div>

    @livewire('checkout-component')

</div>
@endsection