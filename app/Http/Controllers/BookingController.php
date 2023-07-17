<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Facility;
use App\Models\Feature;
use Auth;

class BookingController extends Controller
{
    //
    public function index()
    {
        $booking = Booking::with('room')->latest()->get();

        return view('admin.booking.index', compact('booking'))->with('i');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $crud = $booking->delete();

        if($crud){
            return redirect()->route('home.detail')->with('status', 'Success');
        }
    }
}
