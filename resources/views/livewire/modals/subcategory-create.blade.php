<div class="fixed inset-0 bg-black/50 flex items-center justify-center" wire:click.self="closeModal">
    <div class="bg-white p-6 rounded shadow-lg">
        @if($errors->any())
        <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <h3 class="text-lg font-bold mb-4">Create New Subcategory</h3>
        <form wire:submit.prevent="createSubcategory">
            <div class="mb-2">
                <select wire:model="category_id" class="border p-2 w-full">
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-2">
                <label for="category_name">Subcategory Name</label>
                <input type="text" wire:model="subcategory_name" placeholder="Subcategory Name" class="border p-2 w-full" required>
            </div>
            <div class="mb-2">
                <label for="category_description">Subcategory Description</label>
                <input type="text" wire:model="subcategory_description" placeholder="Subcategory Description" class="border p-2 w-full" required>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-4">Save</button>
        </form>
    </div>
</div>