@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@php
// Get user based on the guard
$user = Auth::guard('admin')->check() ? Auth::guard('admin')->user() : Auth::guard('web')->user();
@endphp

@if($user)
<p>Welcome, {{ $user->role === 'admin' ? 'Admin' : 'User' }} {{ $user->name }}!</p>
<p>Email: {{ $user->email }}</p>
@else
<p>Welcome, Guest!</p>
@endif

@endsection