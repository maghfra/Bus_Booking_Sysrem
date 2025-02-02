<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = ['bus_id', 'from_city_id', 'to_city_id', 'departure_time', 'arrival_time'];

    public function bus() {
        return $this->belongsTo(Bus::class);
    }

    public function fromCity() {
        return $this->belongsTo(City::class, 'from_city_id');
    }

    public function toCity() {
        return $this->belongsTo(City::class, 'to_city_id');
    }

    public function stops() {
        return $this->hasMany(Trip_Stop::class);
    }
}
