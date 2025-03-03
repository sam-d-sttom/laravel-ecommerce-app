@extends('layouts.adminDashboard')

@section('content')
<div class="h-full relative flex flex-col mx-auto pt-18 w-full">
    <div class="absolute top-0 left-0 h-16 w-full flex items-center px-20">
        <h2 class="text-lg md-text-2xl font-bold">Manage Categories & Subcategories</h2>
    </div>

    @livewire('admin-category-component')

</div>
@endsection