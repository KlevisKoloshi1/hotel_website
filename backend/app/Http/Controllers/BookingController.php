<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'apartmentId' => 'required|integer|exists:apartments,id',
            'guest.firstName' => 'required|string|max:255',
            'guest.lastName' => 'required|string|max:255',
            'guest.email' => 'required|email',
            'guest.phone' => 'nullable|string|max:255',
            'guest.address' => 'nullable|string|max:255',
            'guest.city' => 'nullable|string|max:255',
            'guest.zipCode' => 'nullable|string|max:255',
            'guest.country' => 'nullable|string|max:255',
            'checkIn' => 'required|date',
            'checkOut' => 'required|date|after:checkIn',
            'adults' => 'required|integer|min:1',
            'children' => 'nullable|integer|min:0',
            'nightlyPrice' => 'required|integer|min:0',
            'cleaningFee' => 'required|integer|min:0',
            'serviceFee' => 'required|integer|min:0',
            'currency' => 'required|string|size:3',
            'specialRequests' => 'nullable|string',
        ]);

        $apartment = Apartment::findOrFail($validated['apartmentId']);

        $booking = Booking::create([
            'apartment_id' => $apartment->id,
            'check_in' => $validated['checkIn'],
            'check_out' => $validated['checkOut'],
            'adults' => $validated['adults'],
            'children' => $validated['children'] ?? 0,
            'nightly_price' => $validated['nightlyPrice'],
            'cleaning_fee' => $validated['cleaningFee'],
            'service_fee' => $validated['serviceFee'],
            'currency' => $validated['currency'],
            'first_name' => data_get($validated, 'guest.firstName'),
            'last_name' => data_get($validated, 'guest.lastName'),
            'email' => data_get($validated, 'guest.email'),
            'phone' => data_get($validated, 'guest.phone'),
            'address' => data_get($validated, 'guest.address'),
            'city' => data_get($validated, 'guest.city'),
            'zip_code' => data_get($validated, 'guest.zipCode'),
            'country' => data_get($validated, 'guest.country'),
            'special_requests' => $validated['specialRequests'] ?? null,
            'status' => 'confirmed',
        ]);

        return response()->json([
            'id' => $booking->id,
            'reference' => 'MRS-'.str_pad((string)($booking->id % 10000), 4, '0', STR_PAD_LEFT),
        ], 201);
    }
}


