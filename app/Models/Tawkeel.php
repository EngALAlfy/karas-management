<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tawkeel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price_20',
        'price_40',
    ];

}
