<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('purchase_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('purchase_id')->constrained('purchases')->onDelete('cascade');
            $table->integer('quantity')->unsigned();
            $table->decimal('purchase_price',10,2);
            $table->decimal('selling_price',10,2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('purchase_product');
    }
};
