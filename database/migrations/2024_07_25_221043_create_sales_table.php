<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_time');
            $table->decimal('tax',8,2,true);
            $table->string('receipt_number',255);
            $table->decimal('total',8,2)->unsigned();
            $table->tinyInteger('status')->default(1);
            $table->foreignId('client_id')->nullable()->constrained('clients')->onDelete('set null');
            $table->foreignId('receipt_id')->nullable()->constrained('receipts')->onDelete('set null');
            $table->foreignId('provider_id')->nullable()->constrained('providers')->onDelete('set null');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('sales');
    }
};
