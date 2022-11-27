<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PrintRecord extends Model
{
    use HasFactory;

    protected $table = "print_records";

    protected $fillable = [
        'number',
        'date',
        'tawkeel',
        'mekawel',
        'name',
        's_w',
        'count_40',
        'count_20',
        'h_t',
        'sum',
        'grant',
        'print_date_id',
    ];


    function records()
    {
        return $this->belongsTo(PrintDate::class);
    }
}
