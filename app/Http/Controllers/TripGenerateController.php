<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Trip_Stop;
use Illuminate\Http\Request;

class TripGenerateController extends Controller
{
    public function index(Request $request)
    {

        $request->validate([
            'bus_id' => 'required|exists:buses,id',
            'from_city_id' => 'required|exists:cities,id',
            'to_city_id' => 'required|exists:cities,id|different:from_city_id',
            'departure_time' => 'required|date|after:now',
            'arrival_time' => 'required|date|after:departure_time',
            'stops' => 'array',
            'stops.*' => 'exists:cities,id',
        ]);

        $trip = Trip::create([
            'bus_id' => $request->bus_id,
            'from_city_id' => $request->from_city_id,
            'to_city_id' => $request->to_city_id,
            'departure_time' => $request->departure_time,
            'arrival_time' => $request->arrival_time,
        ]);

        if ($request->has('stops')) {
            foreach ($request->stops as $index => $stop) {
                Trip_Stop::create([
                    'trip_id' => $trip->id,
                    'station_id' => $stop,
                    'stop_order' => $index + 1,
                ]);
            }
        }

        return response()->json([
            'message' => 'Trip created successfully',
            'trip' => $trip->load('stops'),
        ], 201);
    }

}
