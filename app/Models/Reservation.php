<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'table_id',
        'reservation_date',
        'reservation_time',
        'number_of_guests',
        'status',
    ];

    protected $casts = [
        'reservation_date' => 'date',
    ];

    public function getFormattedReservationDateAttribute()
    {
        return Carbon::parse($this->reservation_date)->format('d/m/Y');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }
}