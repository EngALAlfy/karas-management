<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintDate extends Model
{
    use HasFactory;

    protected $table = "print_dates";


    protected $fillable = [
        'date',
    ];
}
