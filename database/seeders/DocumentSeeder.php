<?php

namespace Database\Seeders;

use App\Models\Document;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Document::insert([
            [
                'document_type' => 'DNI',
            ],

            [
                'document_type' => 'Pasaporte',
            ],

            [
                'document_type' => 'RUC',
            ],
            [
                'document_type' => 'Carnet Extranjería',
            ]
        ]);
    }
}
