<div>
    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-2 mb-4">
            {{ session('message') }}
        </div>
    @endif

    <!-- Button to toggle Create Product Modal -->
    <button wire:click="toggleCreateForm" class="bg-blue-600 text-white px-4 py-2 mb-4">
        @if($createMode)
            Cancel Create Product
        @else
            Create New Product
        @endif
    </button>

    <!-- Create Product Modal -->
    @if($createMode)
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg">
                <button wire:click="toggleCreateForm" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">&times;</button>

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
            </div>
        </div>
    @endif

    <!-- Product List -->
    <h2 class="text-xl font-bold mt-8 mb-4">Product List</h2>
    <table class="table-auto w-full text-white">
        <thead>
        <tr>
            <th class="px-4 py-2 text-center">Name</th>
            <th class="px-4 py-2 text-center">Price</th>
            <th class="px-4 py-2 text-center">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($products as $product)
            <tr class="text-center">
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
