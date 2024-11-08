<?php
use App\Livewire\Admin\ProductManager;
use App\Livewire\Products;  // Or a controller if you're using a controller
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Products page route for customers
Route::get('/products', Products::class)->name('products');  // Livewire component or controller

// Admin dashboard route
Route::get('/admin', ProductManager::class)->name('admin.product-manager');

// Login page route
Route::get('/login', function () {
return view('auth.login');
})->name('login');

// Logout route
Route::get('/logout', function () {
Auth::logout();
return redirect()->route('login');  // Redirect to the login page after logout
})->name('logout');

// Redirect authenticated users to the appropriate page
Route::middleware('auth')->group(function () {
// This is a fallback to handle any additional redirection needs
Route::get('/home', function () {
if (Auth::user()->role == 'customer') {
return redirect()->route('products');  // Redirect customers to the products page
} else {
return redirect()->route('admin.dashboard');  // Redirect admins to the admin dashboard
}
});
});
