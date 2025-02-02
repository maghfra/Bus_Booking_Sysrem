<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip_Stop extends Model
{
    use HasFactory;

    protected $fillable = ['trip_id', 'station_id', 'stop_order'];

    public function trip() {
        return $this->belongsTo(Trip::class);
    }

    public function station() {
        return $this->belongsTo(City::class, 'station_id');
    }
}
