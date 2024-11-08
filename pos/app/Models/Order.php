<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'total_price'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product')
            ->withPivot(['product_name', 'product_price', 'quantity']);
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'order_menu')
            ->withPivot(['menu_name', 'menu_price', 'quantity']);
    }

    public function removedIngredients()
    {
        return $this->hasMany(OrderRemovedIngredient::class);
    }
}
