<div>
    <!-- Sidebar and Category Selection (Existing Code) -->
    <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
        </svg>
    </button>


    <aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto antialiased bg-gray-800">
            <ul class="space-y-2 font-medium flex flex-col items-center">

                    @foreach ($categories as $category)
                        <li class="w-full">
                            <button wire:click="$set('selectedCategory', {{ $category->id }})"
                                    class="flex items-center justify-center p-2 rounded-lg text-white group w-full
                            {{ $selectedCategory == $category->id && !$showMenus ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                                @if ($category->name === 'Pizza')
                                    <x-fas-pizza-slice class="w-6 h-6 text-gray-400 mr-3"/>
                                @elseif ($category->name === 'Pasta')
                                    <x-fas-utensils  class="w-6 h-6 text-gray-400 mr-3"/>
                                @elseif ($category->name === 'Burger')
                                    <x-fas-burger class="w-6 h-6 text-gray-400 mr-3"/>
                                @elseif ($category->name === 'Drinks')
                                    <x-fas-whiskey-glass class="w-6 h-6 text-gray-400 mr-3"/>
                                @else ()
                                    <x-fas-whiskey-glass class="w-6 h-6 text-gray-400 mr-3"/>
                                @endif
                                <span>{{ $category->name }}</span>
                            </button>

                        </li>
                    @endforeach
                        <!-- Menu Item -->
                        <li class="w-full">
                            <button wire:click="showMenus"
                                    class="flex items-center justify-center p-2 rounded-lg text-white group w-full
                    {{ $showMenus ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                                <x-fas-bars class="w-6 h-6 text-gray-400 mr-3"/>
                                <span>Menu's</span>
                            </button>
            </ul>
        </div>
    </aside>

    <!-- Products Section -->
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg">
            <div class="grid grid-cols-3 gap-4 mb-4">
                @if ($showMenus)
                    @foreach ($menus as $menu)
                        <div>
                            <button>
                                <div class="flex items-center justify-center rounded bg-gray-50 h-500 h-500">
                                    <div class="w-full bg-white border border-gray-200 rounded-lg shadow">
                                        <a href="#">
                                            @if ($menu->image_path)
                                                <img class="p-8 rounded-t-lg" src="{{ $menu->image_path }}" alt="{{ $menu->name }} image"/>
                                            @else
                                                <img class="p-8 rounded-t-lg" src="/images/stock-image.jpg" alt="Default Stock Image"/>
                                            @endif
                                        </a>
                                        <div class="px-5 pb-5">
                                            <h5 class="text-xl font-semibold tracking-tight text-gray-900">{{ $menu->name }}</h5>
                                            <p class="text-gray-700">{{ $menu->description }}</p>
                                        </div>
                                        <div class="flex items-center justify-between p-5">
                                            <span class="text-3xl font-bold text-gray-900">${{ $menu->price }}</span>
                                        </div>
                                    </div>
                                </div>
                            </button>
                        </div>
                    @endforeach
                @else
                    @foreach ($products as $product)
                        <div>
                            <button onclick="openProductModal({{ $product->id }}, '{{ $product->name }}', '{{ $product->image_path }}', '{{ $product->ingredients }}')">
                                <div class="flex items-center justify-center rounded bg-gray-50 h-500 h-500">
                                    <div class="w-full bg-white border border-gray-200 rounded-lg shadow">
                                        <a href="#">
                                            @if ($product->image_path)
                                                <img class="p-8 rounded-t-lg" src="{{ $product->image_path }}" alt="{{ $product->name }} image"/>
                                            @else
                                                <img class="p-8 rounded-t-lg" src="/images/stock-image.jpg" alt="Default Stock Image"/>
                                            @endif
                                        </a>
                                        <div class="px-5 pb-5">
                                            <h5 class="text-xl font-semibold tracking-tight text-gray-900">{{ $product->name }}</h5>
                                            <p class="text-gray-700">{{ $product->description }}</p>
                                        </div>
                                        <div class="flex items-center justify-between p-5">
                                            <span class="text-3xl font-bold text-gray-900">${{ $product->price }}</span>
                                        </div>
                                    </div>
                                </div>
                            </button>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <!-- Product Modal -->
    <div id="productModal" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
        <div class="bg-white p-8 rounded-lg max-w-3xl mx-auto relative">
            <button id="closeModal" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
                <x-fas-times class="w-6 h-6"/>
            </button>

            <!-- Product Content -->
            <div class="flex flex-col items-center">
                <h3 class="text-2xl font-semibold text-gray-900 mb-4" id="modalProductName">Product Name</h3>
                <img class="rounded-t-lg mb-4 max-h-72"  id="modalProductImage" src="" alt="Product Image" />
                <p class="text-lg text-gray-700 mb-4">Description of the product...</p>

                <!-- Ingredients List -->
                <ul id="modalProductIngredients" class="list-none space-y-2 text-lg">
                    <!-- Ingredients will be dynamically loaded here -->
                </ul>

                <div class="mt-6">
                    <button id="addToCartButton" class="bg-blue-500 text-white py-2 px-6 rounded-lg hover:bg-blue-600">Add to Cart</button>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- JavaScript -->
<script>
    // Function to open the product modal with ingredients and quantity control
    function openProductModal(id, name, image, ingredients) {
        document.getElementById('modalProductName').textContent = name;
        document.getElementById('modalProductImage').src = image;

        const ingredientsList = JSON.parse(ingredients);
        const ingredientsListElement = document.getElementById('modalProductIngredients');

        ingredientsListElement.innerHTML = '';  // Clear any previous content

        // Loop through ingredients and add input fields with + and - buttons
        ingredientsList.forEach(ingredient => {
            const li = document.createElement('li');
            const quantityControl = `
                <div class="flex items-center space-x-2">
                    <span class="text-lg">${ingredient.name}</span>
                    <div class="flex items-center space-x-2">
                        <button onclick="decreaseQuantity(this)" class="bg-gray-300 text-black py-1 px-2 rounded hover:bg-gray-400">-</button>
                        <input type="number" value="1" min="0" max="1" class="w-16 text-center border rounded-md" readonly>
                        <button onclick="increaseQuantity(this)" class="bg-gray-300 text-black py-1 px-2 rounded hover:bg-gray-400">+</button>
                    </div>
                </div>
            `;
            li.innerHTML = quantityControl;
            ingredientsListElement.appendChild(li);
        });

        // Show the modal
        document.getElementById('productModal').classList.remove('hidden');
    }

    // Function to decrease the quantity to 0
    function decreaseQuantity(button) {
        const inputField = button.nextElementSibling;  // Get the input field
        inputField.value = 0;
    }

    // Function to increase the quantity to 1
    function increaseQuantity(button) {
        const inputField = button.previousElementSibling;  // Get the input field
        inputField.value = 1;
    }

    // Close the product modal
    document.getElementById('closeModal').addEventListener('click', () => {
        document.getElementById('productModal').classList.add('hidden');
    });

    // Close the modal by clicking outside
    document.getElementById('productModal').addEventListener('click', (e) => {
        if (e.target === document.getElementById('productModal')) {
            document.getElementById('productModal').classList.add('hidden');
        }
    });
</script>
