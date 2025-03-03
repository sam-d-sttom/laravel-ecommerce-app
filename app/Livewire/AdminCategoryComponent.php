<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Validator;

class AdminCategoryComponent extends Component
{
    use WithPagination;

    public $category_name, $category_description, $category_id, $subcategory_name, $subcategory_description, $editCategoryId, $editSubcategoryId;

    public $categories = [];
    public $showCategoryModal = false;
    public $showSubcategoryModal = false;
    public $showEditCategoryModal = false;
    public $showEditSubcategoryModal = false;

    protected $rules = [
        'name' => 'required|min:3|unique:categories,name',
        'subcategory_name' => 'required|min:3|unique:subcategories,name',
        'category_id' => 'required|exists:categories,id',
    ];

    // Show Category Modal
    public function openCategoryModal()
    {
        $this->reset(['category_name', 'category_description']);
        $this->showCategoryModal = true;
    }

    // Create Category
    public function createCategory()
    {
        try {
            // Validate input fields
            $this->validate([
                'category_name' => 'required|string|min:3|max:255|unique:categories,name',
                'category_description' => 'required|string|min:3|max:500',
            ]);

            Category::create([
                'name' => $this->category_name,
                'description' => $this->category_description,
            ]);

            session()->flash('success', 'Category created successfully!');
            $this->showCategoryModal = false;
            $this->reset(['category_name', 'category_description']);
            $this->resetValidation();
        } catch (\Exception $e) {
        }
    }

    // Show Subcategory Modal
    public function openSubcategoryModal()
    {
        $this->reset(['subcategory_name', 'subcategory_description', 'category_id']);
        $this->categories = Category::all();
        $this->showSubcategoryModal = true;
    }

    // Create Subcategory
    public function createSubcategory()
    {
        try {
            // Validate input fields
            $this->validate([
                'category_id' => 'required|exists:categories,id',
                'subcategory_name' => 'required|string|min:3|max:255|unique:sub_categories,name',
                'subcategory_description' => 'required|string|min:3|max:500',
            ]);

            Subcategory::create([
                'name' => $this->subcategory_name,
                'description' => $this->subcategory_description,
                'category_id' => $this->category_id
            ]);

            session()->flash('success', 'Subcategory created successfully!');
            $this->showSubcategoryModal = false;
            $this->resetValidation();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    // Edit Category
    public function openEditCategoryModal($id)
    {
        // work in progress <(^-^)>
    }

    public function updateCategory()
    {
        // work in progress <(^-^)>
    }

    // Edit Subcategory
    public function openEditSubcategoryModal($id)
    {
        // work in progress <(^-^)>
    }

    public function updateSubcategory()
    {
        // work in progress <(^-^)>
    }

    public function closeModal()
    {
        $this->showCategoryModal = false;
        $this->showSubcategoryModal = false;
        $this->showEditCategoryModal = false;
        $this->showEditSubcategoryModal = false;
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.admin-category-component', [
            'paginated_categories' => Category::with('subcategories')->paginate(5)
        ]);
    }
}
