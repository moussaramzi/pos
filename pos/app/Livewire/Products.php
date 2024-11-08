<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\Menu;
use Livewire\Component;

class Products extends Component
{
    public $products;
    public $categories;
    public $menus;
    public $selectedCategory;
    public $showMenu = false;

    public function mount()
    {
        $this->categories = Category::all();
        $this->selectedCategory = $this->categories->firstWhere('name', 'Pizza')->id ?? null;
        $this->products = Product::where('category_id', $this->selectedCategory)->get();
        $this->menus = Menu::all();
    }

    public function updatedSelectedCategory($categoryId)
    {
        $this->showMenu = false;
        $this->products = Product::where('category_id', $categoryId)->get();

    }

    public function showMenus()
    {
        $this->showMenu = true;
        $this->selectedCategory = null;

    }

    public function render()
    {
        return view('livewire.products', [
            'products' => $this->products,
            'categories' => $this->categories,
            'menus' => $this->menus,
            'showMenus' => $this->showMenu,
            'selectedCategory' => $this->selectedCategory,
        ]);
    }
}
