<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('business_name');  //razon_social
            $table->string('address');
            $table->string('person_type');
            $table->tinyInteger('status')->default(1);
            $table->foreignId('document_id')->unique()->constrained('documents')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('people');
    }
};
