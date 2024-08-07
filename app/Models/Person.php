<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    public function document(){
        return $this->belongsTo(Document::class);
    }

    public function provider(){
        return $this->hasOne(Provider::class);
    }

    public function client(){
        return $this->hasOne(Client::class);
    }

    protected $fillable = ['business_name','address','person_type','document_id', 'document_number'];

}
