<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presentation extends Model
{
    use HasFactory;

    public function products(){
        return $this->belongsToMany(Product::class);
    }

    public function property(){
        return $this->belongsTo(property::class)->withTimestamps();
    }
}
