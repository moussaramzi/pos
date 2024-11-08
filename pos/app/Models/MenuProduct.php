<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuProduct extends Model
{
    protected $table = 'menu_product';

    protected $fillable = [
        'menu_id', 'product_id', 'quantity',
    ];

    // Define relationships if needed
}
