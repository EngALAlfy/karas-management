<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'date',
        'tawkeel_id',
        'mekawel_id',
        'name',
        's_w',
        'count_40',
        'count_20',
        'h_t',
        'grant',
    ];

    function tawkeel(){
        return $this->belongsTo(Tawkeel::class);
    }

    function mekawel(){
        return $this->belongsTo(Mekawel::class);
    }
}
