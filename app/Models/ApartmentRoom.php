<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApartmentRoom extends Model
{
    use HasFactory;

    protected $fillable = ['apartment_id', 'room_number', 'price', 'occupants', 'image'];

    public function rents()
    {
        return $this->hasMany(MonthlyRent::class);
    }
}

