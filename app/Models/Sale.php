<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{

    use HasFactory;

    protected $guarded = ['id'];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function receipt(){
        return $this->belongsTo(Receipt::class);
    }

    public function products(){
        return $this->belongsToMany(Product::class, 'sale_product')
         ->withTimestamps()
         ->withPivot('quantity', 'discount', 'selling_price');;
    }

}
