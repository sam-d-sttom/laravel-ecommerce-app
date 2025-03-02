<section class="flex flex-col justify-between h-full w-full">
    <div class="overflow-y-scroll px-4 md:px-10 grow">

        <!-- Buttons -->
        <div class="mb-4 flex flex-col sm:flex-row sm:space-x-4 space-y-2 sm:space-y-0">
            <button wire:click="openCategoryModal"
                class="cursor-pointer bg-blue-500 text-white px-4 py-2 rounded w-full sm:w-auto">
                + New Category
            </button>
            <button wire:click="openSubcategoryModal"
                class="cursor-pointer bg-green-500 text-white px-4 py-2 rounded w-full sm:w-auto">
                + New Subcategory
            </button>
        </div>

        <!-- Table Container (For Responsive Scrolling) -->
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border text-left min-w-[600px] md:min-w-0">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-3 border w-1/3">Category</th>
                        <th class="p-3 border w-1/2">Subcategories</th>
                        <th class="p-3 border w-1/6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($paginated_categories as $category)
                    <tr class="border">
                        <!-- Category Name -->
                        <td class="p-3 align-middle border">{{ $category->name }}</td>

                        <!-- Subcategories -->
                        <td class="p-3 align-middle border">
                            <div class="flex flex-wrap gap-2">
                                @forelse ($category->subcategories as $subcategory)
                                <span class="bg-gray-200 text-gray-700 px-2 py-1 rounded whitespace-nowrap">
                                    {{ $subcategory->name }}
                                </span>
                                @empty
                                <span class="text-gray-500 italic">No subcategories</span>
                                @endforelse
                            </div>
                        </td>

                        <!-- Actions -->
                        <td class="p-3 text-center">
                            <button wire:click="openEditCategoryModal({{ $category->id }})"
                                class="bg-yellow-500 text-white px-3 py-1 rounded">
                                Edit
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $paginated_categories->links() }}
        </div>

        <!-- Modals -->
        @if ($showCategoryModal)
        @include('livewire.modals.category-create')
        @endif

        @if ($showSubcategoryModal)
        @include('livewire.modals.subcategory-create')
        @endif

        @if ($showEditCategoryModal)
        @include('livewire.modals.category-edit')
        @endif

        @if ($showEditSubcategoryModal)
        @include('livewire.modals.subcategory-edit')
        @endif
    </div>
</section>
