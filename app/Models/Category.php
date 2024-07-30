<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function products(){
        return $this->belongsToMany(Product::class)->withTimestamps();
    }

    public function property(){
        return $this->belongsTo(Property::class);
    }

    protected $filliable = ['property_id'];
    protected $guarded = ['id'];

}
