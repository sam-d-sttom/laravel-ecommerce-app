<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class ProductSearchComponent extends Component
{
    use WithPagination;

    public $search = '';
    public $category = '';
    public $minPrice = 0;
    public $maxPrice = 1000;
    public $dropDownResults = [];
    public $searchTriggered = false;

    public function updated($propertyName)
    {
        // dd('search updated');
        if (in_array($propertyName, ['search', 'category', 'minPrice', 'maxPrice'])) {
            $this->searchProductsDropDown();
        }
    }

    public function searchProductsDropDown()
    {
        // If search is empty, do not return any results
        if (empty($this->search) || $this->searchTriggered !== false) {
            $this->dropDownResults = [];
            return;
        }

        $query = Product::query();

        $query->where(function ($q) {
            $q->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('description', 'like', '%' . $this->search . '%');
        });

        if (!empty($this->category)) {
            $query->where('category_id', $this->category);
        }

        if (!empty($this->minPrice)) {
            $query->where('price', '>=', $this->minPrice);
        }

        if (!empty($this->maxPrice)) {
            $query->where('price', '<=', $this->maxPrice);
        }

        $this->dropDownResults = $query->limit(10)->get();
    }


    public function triggerSearch()
    {
        $this->searchTriggered = true;
        $this->dropDownResults = [];
        $this->resetPage();
    }


    public function render()
    {
        $products = Product::query();

        if ($this->searchTriggered) {

            // if search is empty reset.
            if (empty($this->search)) {
                $this->searchTriggered = false;
                return view('livewire.product-search-component', [
                    'categories' => Category::all(),
                    'searchResultsPaginated' => null // Before search is triggered, no results are shown
                ]);
            }

            if (!empty($this->search)) {
                $products->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%');
                });

                if (!empty($this->category)) {
                    $products->where('category_id', $this->category);
                }

                if (!empty($this->minPrice)) {
                    $products->where('price', '>=', $this->minPrice);
                }

                if (!empty($this->maxPrice)) {
                    $products->where('price', '<=', $this->maxPrice);
                }
            }

            return view('livewire.product-search-component', [
                'categories' => Category::all(),
                'searchResultsPaginated' => $products->paginate(4) // Fetch paginated results only after search is triggered
            ]);
        }

        return view('livewire.product-search-component', [
            'categories' => Category::all(),
            'searchResultsPaginated' => null // Before search is triggered, no results are shown
        ]);
    }
}
