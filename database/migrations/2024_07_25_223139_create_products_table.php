<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code',50);
            $table->string('name',80);
            $table->integer('strock')->unsigned()->default(0);
            $table->string('description',255)->nullable();
            $table->date('expiration_date')->nullable();
            $table->string('img_path',255)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->foreignId('brand_id')->nullable()->constrained('brands')->onDelete('set null');
            $table->foreignId('presentation_id')->nullable()->constrained('presentations')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
