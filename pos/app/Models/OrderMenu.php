<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderMenu extends Pivot
{
    protected $table = 'order_menu';

    protected $fillable = [
        'order_id', 'menu_id', 'menu_name', 'menu_price', 'quantity',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
