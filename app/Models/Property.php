<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    public function category(){
        return $this->hasOne(Category::class);
    }

    public function brand(){
        return $this->hasOne(Brand::class);
    }

    public function presentation(){
        return $this->hasOne(Presentation::class);
    }

    protected $filliable = ['name', 'description'];
    protected $guarded = ['id'];

}
