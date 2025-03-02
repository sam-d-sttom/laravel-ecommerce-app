@extends('layouts.dashboard')

@section('title', 'Ecormmerce | Order')

@section('content')
<div class="h-full relative flex flex-col mx-auto pt-18 w-full">
    <div class="absolute top-0 left-0 h-16 w-full flex items-center pl-6">
        <h1 class="text-2xl font-bold">Your Order</h1>
    </div>

    @livewire('order-component', ['orderId' => $orderId])

</div>
@endsection