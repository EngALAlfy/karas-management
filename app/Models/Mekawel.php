<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mekawel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
    ];

    function tawkeels(){
        return $this->belongsToMany(Tawkeel::class)->withPivot("mekawel_price_20","mekawel_price_40");
    }

    function orders(){
        return $this->hasMany(Order::class);
    }
}
