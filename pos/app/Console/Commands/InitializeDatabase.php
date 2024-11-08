<?php

namespace App\Console\Commands;

use App\Models\Ingredient;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Menu;
use App\Models\Sauce; // Adding Sauce model
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class InitializeDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:initialize';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize the database with sample data';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $this->info("Initializing the database...");
        // Create users
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('adminpassword'),
            'type' => 'admin'
        ]);

        User::create([
            'name' => 'Customer',
            'email' => 'customer@example.com',
            'password' => bcrypt('customerpassword'),
            'type' => 'customer'
        ]);

        // Categories
        $categories = [
            'Pizza', 'Pasta', 'Burger', 'Sauce', 'Drinks'
        ];

        foreach ($categories as $categoryName) {
            Category::create(['name' => $categoryName]);
        }

        // Products
        $products = [
            ['name' => 'Margherita', 'description' => 'Classic cheese pizza', 'price' => 8.99, 'category_id' => 1],
            ['name' => 'Spaghetti Bolognese', 'description' => 'Traditional Italian pasta', 'price' => 12.99, 'category_id' => 2],
            ['name' => 'Cheeseburger', 'description' => 'Juicy beef burger with cheese', 'price' => 10.99, 'category_id' => 3],
            ['name' => 'BBQ Sauce', 'description' => 'Rich and smoky sauce', 'price' => 1.99, 'category_id' => 4],
            ['name' => 'Coca Cola', 'description' => 'Refreshing soda drink', 'price' => 1.50, 'category_id' => 5],
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }

        // Menus
        $menus = [
            ['name' => 'Combo 1', 'description' => 'Pizza, Pasta, and Drink', 'price' => 20.99],
        ];

        foreach ($menus as $menuData) {
            Menu::create($menuData);
        }

        // Ingredients with prices
        $ingredients = [
            ['name' => 'Tomato Sauce', 'price' => 0.50],
            ['name' => 'Cheese', 'price' => 0.75],
            ['name' => 'Bacon', 'price' => 1.25],
            ['name' => 'Lettuce', 'price' => 0.30],
            ['name' => 'Chicken', 'price' => 1.50],
        ];

        foreach ($ingredients as $ingredientData) {
            Ingredient::create($ingredientData);
        }

        // Sauces with prices
        $sauces = [
            ['name' => 'Ketchup', 'price' => 0.25],
            ['name' => 'Mayonnaise', 'price' => 0.30],
            ['name' => 'Barbecue', 'price' => 0.40],
        ];

        foreach ($sauces as $sauceData) {
            Sauce::create($sauceData);
        }

        // Product-Ingredient relationships
        $productIngredients = [
            ['product_id' => 1, 'ingredient_id' => 1], // Margherita -> Tomato Sauce
            ['product_id' => 1, 'ingredient_id' => 2], // Margherita -> Cheese
            ['product_id' => 2, 'ingredient_id' => 5], // Spaghetti Bolognese -> Chicken
            ['product_id' => 3, 'ingredient_id' => 3], // Cheeseburger -> Bacon
            ['product_id' => 3, 'ingredient_id' => 4], // Cheeseburger -> Lettuce
        ];

        foreach ($productIngredients as $pi) {
            DB::table('product_ingredient')->insert($pi);
        }

        // Menu-Product relationships
        DB::table('menu_product')->insert([
            ['menu_id' => 1, 'product_id' => 1, 'quantity' => 1],
            ['menu_id' => 1, 'product_id' => 2, 'quantity' => 1],
            ['menu_id' => 1, 'product_id' => 5, 'quantity' => 1],
        ]);
        $this->info("Database initialization completed.");

    }
}
