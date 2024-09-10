<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    const LOCATIONS = [
        'intérieur' => 'Intérieur',
        'extérieur' => 'Extérieur',
        'bar' => 'Bar'
    ];

    protected $fillable = [
        'number',
        'capacity',
        'is_available',
        'location'
    ];

    protected $casts = [
        'is_available' => 'boolean',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}