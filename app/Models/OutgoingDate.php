<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutgoingDate extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
    ];
}
