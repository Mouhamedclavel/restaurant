<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $fillable = ['number', 'location', 'capacity', 'is_available'];

    protected $casts = [
        'is_available' => 'boolean',
    ];

    const LOCATIONS = [
        'intérieur' => 'Intérieur',
        'extérieur' => 'Extérieur',
        'bar' => 'Bar'
    ];
}