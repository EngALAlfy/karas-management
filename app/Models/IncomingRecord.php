<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomingRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'paid',
        'unpaid',
        'date',
        'incoming_date_id',
    ];
}
