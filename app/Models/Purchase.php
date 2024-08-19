<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_time',
        'tax',
        'receipt_number',
        'total',
        'receipt_id',
        'provider_id'
    ];

    public function provider(){
        return $this->belongsTo(Provider::class);
    }

    public function receipt(){
        return $this->belongsTo(Receipt::class);
    }

    public function products(){
        return $this->belongsToMany(Product::class)->withTimestamps()
         ->withPivot('quantity', 'purchase_price', 'selling_price');
    }
}
