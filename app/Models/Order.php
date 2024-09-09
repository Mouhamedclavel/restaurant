<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'total',
        // Ajoutez d'autres champs selon vos besoins
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Ajoutez d'autres relations ou méthodes si nécessaire
}