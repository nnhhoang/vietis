<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'image'];

    public function rooms()
    {
        return $this->hasMany(ApartmentRoom::class);
    }
}