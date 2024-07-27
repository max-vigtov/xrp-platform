<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('sale_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('sale_id')->constrained('sales')->onDelete('cascade');
            $table->integer('quantity')->unsigned();
            $table->decimal('selling_price',10,2);
            $table->decimal('discount',8,2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sale_product');
    }
};
