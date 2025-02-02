<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Seat;
use App\Models\Trip;
use App\Models\Trip_Stop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TripBookingController extends Controller
{
    public function bookSeat(Request $request)
    {
        $request->validate([
            'trip_id' => 'required|exists:trips,id',
            'seat_id' => 'required|exists:seats,id',
            'from_station_id' => 'required|exists:cities,id',
            'to_station_id' => 'required|exists:cities,id|different:from_station_id',
        ]);
    
        $trip = Trip::findOrFail($request->trip_id);
        $seat = Seat::findOrFail($request->seat_id);
        $userId = Auth::id();
    
        //Fetch all stops including start & end stations
        $tripStops = Trip_Stop::where('trip_id', $trip->id)
            ->orderBy('stop_order')
            ->pluck('station_id')
            ->toArray();
    
        array_unshift($tripStops, $trip->from_city_id);
        $tripStops[] = $trip->to_city_id; 

        // Validate if stations exist in the trip
        $fromIndex = array_search($request->from_station_id, $tripStops);
        $toIndex = array_search($request->to_station_id, $tripStops);
    
        if ($fromIndex === false || $toIndex === false || $fromIndex >= $toIndex) {
            return response()->json(['message' => 'Invalid trip segment'], 400);
        }
    
        // Check if the seat is booked for overlapping segments
        $conflictingBooking = Booking::where('trip_id', $trip->id)
        ->where('seat_id', $seat->id)
        ->where('from_station_id', '<', $request->to_station_id)
        ->where('to_station_id', '>', $request->from_station_id)
        ->exists();

    
        if ($conflictingBooking) {
            return response()->json(['message' => 'Seat is already booked for this segment'], 400);
        }
    
        // Book the seat
        $booking = Booking::create([
            'trip_id' => $trip->id,
            'bus_id' => $trip->bus_id,
            'seat_id' => $seat->id,
            'user_id' => $userId,
            'from_station_id' => $request->from_station_id,
            'to_station_id' => $request->to_station_id,
        ]);
    
        return response()->json([
            'message' => 'Seat booked successfully',
            'booking' => $booking,
        ], 201);
    }
    
    public function getAvailableSeats(Request $request)
    {
        $request->validate([
            'trip_id' => 'required|exists:trips,id',
            'from_station_id' => 'required|exists:cities,id',
            'to_station_id' => 'required|exists:cities,id|different:from_station_id',
        ]);
        
        $trip = Trip::findOrFail($request->trip_id);
        $busSeats = Seat::where('bus_id', $trip->bus_id)->pluck('id');


        // Find seats that are booked for the requested trip segment
        $bookedSeats = Booking::where('trip_id', $trip->id)
        ->whereIn('seat_id', $busSeats)
        ->where(function ($query) use ($request) {
            $query->where('from_station_id', '<', $request->to_station_id)
                  ->where('to_station_id', '>', $request->from_station_id);
        })
        ->pluck('seat_id');

        // Get seats that are NOT booked in the requested segment
        $availableSeats = Seat::whereIn('id', $busSeats)
        ->whereNotIn('id', $bookedSeats)
        ->get();

        return response()->json([
            'trip_id' => $trip->id,
            'bus_id' => $trip->bus_id,
            'available_seats' => $availableSeats,
        ]);
    }
}
