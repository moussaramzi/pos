<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\Sauce;
use Livewire\WithFileUploads;

class ProductManager extends Component
{
    use WithFileUploads; // For handling file uploads

    public $products;
    public $name, $description, $price, $is_active = true, $image, $category_id, $sauce_id, $product_id;
    public $updateMode = false;

    // Load products on component mount
    public function mount()
    {
        $this->products = Product::all();
    }

    // Render the component
    public function render()
    {
        $categories = Category::all();
        $sauces = Sauce::all();
        return view('livewire.product-manager', compact('categories', 'sauces'));
    }

    // Create a new product
    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = new Product();
        $product->name = $this->name;
        $product->description = $this->description;
        $product->price = $this->price;
        $product->is_active = $this->is_active;
        $product->category_id = $this->category_id;
        $product->sauce_id = $this->sauce_id;

        // Handle image upload
        if ($this->image) {
            $product->image_path = $this->image->store('images', 'public');
        }

        $product->save();

        $this->resetInputFields();
        session()->flash('message', 'Product created successfully.');
    }

    // Update an existing product
    public function edit($productId)
    {
        $this->updateMode = true;
        $product = Product::findOrFail($productId);
        $this->product_id = $product->id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->is_active = $product->is_active;
        $this->category_id = $product->category_id;
        $this->sauce_id = $product->sauce_id;
    }

    // Update product in the database
    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::findOrFail($this->product_id);
        $product->name = $this->name;
        $product->description = $this->description;
        $product->price = $this->price;
        $product->is_active = $this->is_active;
        $product->category_id = $this->category_id;
        $product->sauce_id = $this->sauce_id;

        if ($this->image) {
            $product->image_path = $this->image->store('images', 'public');
        }

        $product->save();

        $this->resetInputFields();
        $this->updateMode = false;
        session()->flash('message', 'Product updated successfully.');
    }

    // Delete a product
    public function delete($productId)
    {
        Product::find($productId)->delete();
        session()->flash('message', 'Product deleted successfully.');
    }

    // Reset input fields
    private function resetInputFields()
    {
        $this->name = '';
        $this->description = '';
        $this->price = '';
        $this->category_id = '';
        $this->sauce_id = '';
        $this->image = '';
    }
}
