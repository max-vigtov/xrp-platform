<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //DELETE ForeignKey
        Schema::table('people', function (Blueprint $table) {
            $table->dropForeign(['document_id']);
            $table->dropColumn('document_id');
        });
        //CREATE NEW ForeignKey
        Schema::table('people', function (Blueprint $table) {
            $table->foreignId('document_id')->after('status')->constrained('documents')->onDelete('cascade');
        });

        Schema::table('people', function (Blueprint $table) {
            $table->foreignId('number_document',20)->after('document_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //DELETE ForeignKey
        Schema::table('people', function (Blueprint $table) {
            $table->dropForeign(['document_id']);
            $table->dropColumn('document_id');
        });

        //CREATE ForeignKey
        Schema::table('people', function (Blueprint $table) {
            $table->foreignId('document_id')->after('status')->unique()->constrained('documents')->onDelete('cascade');

        });

        //ELIMINAR document_number
        Schema::table('people', function (Blueprint $table) {
            $table->foreignId('number_document');

        });
    }
};
