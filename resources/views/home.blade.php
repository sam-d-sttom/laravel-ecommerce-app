@extends('layouts.app')

@section('title', 'Register')

@section('content')

@if(Auth::check())
<p>Welcome, {{ Auth::user()->name }}!</p>
<p>Email: {{ Auth::user()->email }}</p>
@else
<p>Welcome, Guest!</p>
@endif

@endsection