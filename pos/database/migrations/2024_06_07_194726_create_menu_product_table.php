<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuProductTable extends Migration
{
    public function up()
    {
        Schema::create('menu_product', function (Blueprint $table) {
            $table->foreignId('menu_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->integer('quantity');
            $table->primary(['menu_id', 'product_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('menu_product');
    }
}
