<?php

namespace App\Http\Controllers\Guests;

use App\Http\Controllers\Controller;
use App\Http\Requests\Booking\StoreBookingRequest;
use App\Models\Booking;
use App\Models\Guest;
use App\Traits\GetResponse;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    use GetResponse;

    // Make Booking By Only Guests
    public function store(StoreBookingRequest $request){
         $booking=Booking::create($request->all());
         return $this->dataResponse($booking,'Success');
    }


    // All Bookings for All Guests
    public function indexes(){
        $bookings=Booking::all();

        foreach($bookings as $booking){
            $booking->guest;
            $booking->cabin;
        }
        
        if(empty($bookings)){
            return $this->errorResponse("Bookings are Empty",['bookings'=>'Bookings are empty']);
        }
        return $this->dataResponse($bookings,'Success');
    }


    // The Guest && Cabin For This Booking
    public function index($id){
        $booking=Booking::find($id);
        $booking->guest;
        $booking->cabin;

        if(!$booking){
            return $this->errorResponse("Booking not Found",['booking'=>'Booking not Found']);
        }
        return $this->dataResponse($booking,'Success');
    }

  
    // Bookings for One Guest
    public function guest_bookins($guest_id){
         $guest_bookings=Guest::find($guest_id);
         $guest_bookings->bookings;
         return $this->dataResponse($guest_bookings,'Success');
    }


     // Delete Booking
     public function delete(Booking $booking){

        $booking->delete();
        return $this->successResponse('Booking Deleted Successfully');
   }
}
