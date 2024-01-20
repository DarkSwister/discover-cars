<?php

namespace App\Http\Controllers;

use App\Http\Requests\MakeReservationRequest;
use App\Http\Requests\SingleOfferRequest;
use App\Services\Discovercars\DataTransferObjects\BookingRequestData;
use App\Services\Discovercars\DataTransferObjects\CarOfferData;
use App\Services\Discovercars\LocationService;
use App\Services\Discovercars\OfferService;
use App\Tables\Bookings;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        return view('booking.index', [
            'bookings' => Bookings::class
        ]);
    }

    public function locations(LocationService $locationService)
    {
        $locations = $locationService->locations();
        return view('booking.choose-location-and-car', compact('locations'));
    }

    public function customer(Request $request)
    {
        $offer = session('offer');
        if (!$offer) abort(404);
        return view('booking.booking-confirmation', compact('offer'));
    }

    public function preReservation(SingleOfferRequest $request)
    {
        $offer = CarOfferData::fromArray($request->validated()['offer']);
        session(['offer' => $offer]);
        return redirect()->route('reservation');
    }

    public function success(Request $request)
    {
        $confirmationNumber = $request->get('confirmationNumber');
        return view('booking.booking-success', compact('confirmationNumber'));
    }

    public function store(MakeReservationRequest $request, OfferService $offerService)
    {
        try {
            $booking = $offerService->book(BookingRequestData::fromArray($request->validated()));
            return redirect()->route('reservation.success', ['confirmationNumber' => $booking->confirmation_number]);
        } catch (\Exception $e) {
            abort(400, $e->getMessage());
        }
    }
}
