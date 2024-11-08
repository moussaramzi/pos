<!-- resources/views/livewire/product-manager.blade.php -->
<div>
    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-2 mb-4">
            {{ session('message') }}
        </div>
    @endif

    <!-- Create Product Form -->
    @if($updateMode)
        <h2 class="text-xl font-bold mb-4">Edit Product</h2>
        <form wire:submit.prevent="update">
            <div class="mb-4">
                <label class="block">Name</label>
                <input type="text" wire:model="name" class="border p-2 w-full">
            </div>
            <div class="mb-4">
                <label class="block">Description</label>
                <textarea wire:model="description" class="border p-2 w-full"></textarea>
            </div>
            <div class="mb-4">
                <label class="block">Price</label>
                <input type="number" wire:model="price" class="border p-2 w-full">
            </div>
            <div class="mb-4">
                <label class="block">Category</label>
                <select wire:model="category_id" class="border p-2 w-full">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block">Sauce</label>
                <select wire:model="sauce_id" class="border p-2 w-full">
                    @foreach ($sauces as $sauce)
                        <option value="{{ $sauce->id }}">{{ $sauce->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block">Image</label>
                <input type="file" wire:model="image" class="border p-2 w-full">
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2">Update Product</button>
        </form>
    @else
        <h2 class="text-xl font-bold mb-4">Create New Product</h2>
        <form wire:submit.prevent="store">
            <div class="mb-4">
                <label class="block">Name</label>
                <input type="text" wire:model="name" class="border p-2 w-full">
            </div>
            <div class="mb-4">
                <label class="block">Description</label>
                <textarea wire:model="description" class="border p-2 w-full"></textarea>
            </div>
            <div class="mb-4">
                <label class="block">Price</label>
                <input type="number" wire:model="price" class="border p-2 w-full">
            </div>
            <div class="mb-4">
                <label class="block">Category</label>
                <select wire:model="category_id" class="border p-2 w-full">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block">Sauce</label>
                <select wire:model="sauce_id" class="border p-2 w-full">
                    @foreach ($sauces as $sauce)
                        <option value="{{ $sauce->id }}">{{ $sauce->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block">Image</label>
                <input type="file" wire:model="image" class="border p-2 w-full">
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2">Create Product</button>
        </form>
    @endif

    <!-- Product List -->
    <h2 class="text-xl font-bold mt-8 mb-4">Product List</h2>
    <table class="table-auto w-full">
        <thead>
        <tr>
            <th class="px-4 py-2">Name</th>
            <th class="px-4 py-2">Price</th>
            <th class="px-4 py-2">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($products as $product)
            <tr>
                <td class="px-4 py-2">{{ $product->name }}</td>
                <td class="px-4 py-2">${{ $product->price }}</td>
                <td class="px-4 py-2">
                    <button wire:click="edit({{ $product->id }})" class="bg-yellow-400 text-white px-2 py-1">Edit</button>
                    <button wire:click="delete({{ $product->id }})" class="bg-red-600 text-white px-2 py-1">Delete</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
