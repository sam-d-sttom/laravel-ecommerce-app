@extends('layouts.adminDashboard')

@section('content')
<div class="h-full relative flex flex-col mx-auto pt-18 w-full">
    <div class="absolute top-0 left-0 h-16 w-full flex items-center px-20">
        <h1 class="text-2xl font-bold">Add Products</h1>
    </div>

    <section class="flex flex-col justify-between h-full w-full">
    <div class="overflow-y-scroll px-10 grow">
        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700">Product Name</label>
                <input type="text" name="name" class="w-full p-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Description</label>
                <textarea name="description" class="w-full p-2 border rounded" rows="3" required></textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Price ($)</label>
                <input type="number" name="price" step="0.01" class="w-full p-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Stock</label>
                <input type="number" name="stock" step="1" class="w-full p-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Category</label>
                <select id="category" name="category_id" class="w-full p-2 border rounded" required>
                    <option value="">Select a Category</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Subcategory</label>
                <select id="subcategory" name="sub_category_id" class="w-full p-2 border rounded" required>
                    <option value="">Select a Subcategory</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Product Image</label>
                <input type="file" name="image" class="w-full p-2 border rounded">
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Product</button>
        </form>
    </div>
    </section>
</div>

<script>
    document.getElementById('category').addEventListener('change', function() {
        let categoryId = this.value;
        let subcategorySelect = document.getElementById('subcategory');

        // reset sub category options
        subcategorySelect.innerHTML = '<option value="">Select a subcategory</option>';

        if (categoryId) {
            fetch(`/get-subcategories/${categoryId}`).then(response => response.json()).then(data => {
                data.forEach(subcategory => {
                    let option = document.createElement('option');
                    option.value = subcategory.id;
                    option.textContent = subcategory.name;
                    subcategorySelect.appendChild(option);
                });
            }).catch(error => console.error('Error fetching subcategories:', error));
        }
    });
</script>
@endsection