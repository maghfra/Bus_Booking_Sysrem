<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function fromTrips() {
        return $this->hasMany(Trip::class, 'from_city_id');
    }

    public function toTrips() {
        return $this->hasMany(Trip::class, 'to_city_id');
    }

    public function tripStops() {
        return $this->hasMany(Trip_Stop::class, 'station_id');
    }
}
