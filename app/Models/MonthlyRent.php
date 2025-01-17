<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyRent extends Model
{
    use HasFactory;

    protected $fillable = [
        'apartment_room_id',
        'electricity',
        'water',
        'total_amount',
        'paid_amount',
        'payment_date',
        'electricity_image',
        'water_image',
    ];

    public function room()
    {
        return $this->belongsTo(ApartmentRoom::class, 'apartment_room_id');
    }
}

