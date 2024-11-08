<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderMenuTable extends Migration
{
    public function up()
    {
        Schema::create('order_menu', function (Blueprint $table) {
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('menu_id')->constrained()->onDelete('cascade');
            $table->string('menu_name');
            $table->decimal('menu_price', 8, 2);
            $table->integer('quantity');
            $table->primary(['order_id', 'menu_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_menu');
    }
}

