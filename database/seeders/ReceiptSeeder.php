<?php

namespace Database\Seeders;

use App\Models\Receipt;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReceiptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Receipt::insert([
            [
                'receipt_type' => 'Recibo'
            ],

            [
                'receipt_type' => 'Factura'
            ]
        ]);
    }
}
