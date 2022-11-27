<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutgoingRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'price',
        'date',
        'outgoing_date_id',
    ];
}
