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
    public function index()
    {
        $bookings = Booking::with('room')->latest()->get();

        return view('admin.booking.index', compact('bookings'));
    }

    public function create()
    {
        $rooms = Room::all();
        $facilities = Facility::all();

        return view('admin.booking.create', compact('rooms', 'facilities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required',
            'check_in' => 'required|date',
            'check_out' => 'required|date',
            'facilities' => 'required|array',
        ]);

        $booking = new Booking();
        $booking->room_id = $request->room_id;
        $booking->check_in = $request->check_in;
        $booking->check_out = $request->check_out;
        $booking->save();

        $booking->facilities()->attach($request->facilities);

        return redirect()->route('booking.index')->with('success', 'Booking created successfully');
    }

    public function show($id)
    {
        $booking = Booking::with('room', 'facilities')->findOrFail($id);

        return view('admin.booking.show', compact('booking'));
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        $rooms = Room::all();
        $facilities = Facility::all();

        return view('admin.booking.edit', compact('booking', 'rooms', 'facilities'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'room_id' => 'required',
            'check_in' => 'required|date',
            'check_out' => 'required|date',
            'facilities' => 'required|array',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->room_id = $request->room_id;
        $booking->check_in = $request->check_in;
        $booking->check_out = $request->check_out;
        $booking->save();

        $booking->facilities()->sync($request->facilities);

        return redirect()->route('booking.index')->with('success', 'Booking updated successfully');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $isDeleted = $booking->delete();

        if ($isDeleted) {
            return redirect()->route('booking.index')->with('success', 'Booking deleted successfully');
        } else {
            return redirect()->route('booking.index')->with('error', 'Failed to delete booking');
        }
    }
}
