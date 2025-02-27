@extends('layouts.app')

@section('title', 'Ecommerce | Home')

@section('content')


<x-product-section title="SHOES" :products="$shoes" />
<x-product-section title="CLOTHES" :products="$clothes"/>
<x-product-section title="WATCHES" :products="$watches"/>

@endsection