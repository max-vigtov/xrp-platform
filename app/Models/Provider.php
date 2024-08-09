<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    public function person(){
        return $this->belongsTo(Person::class);
    }

    public function purchases(){
        return $this->hasMany(Purchase::class);
    }

    protected $fillable = ['person_id'];

}
