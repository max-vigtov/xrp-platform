<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function purchases(){
        return $this->belongsToMany(Purchase::class)->withTimestamps()
        ->withPivot('quantity', 'purchase_price', 'selling_price');;
    }

    public function sales(){
        return $this->belongsToMany(Sale::class)->withTimestamps()
        ->withPivot('quantity', 'discount', 'selling_price');;
    }

    public function categories(){
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function presentation(){
        return $this->belongsTo(Presentation::class);
    }
}
