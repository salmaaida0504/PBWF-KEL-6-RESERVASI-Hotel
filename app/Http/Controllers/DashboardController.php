<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        $date = now()->format('Y-m-d H:i:s');
        $roomCount = Room::count();
        $bookedCount = Booking::where('check_out', '>=', $date)->count();
        $availableCount = Booking::where('check_out', '<', $date)->count();

        return view('admin.dashboard.index', compact('roomCount', 'bookedCount', 'availableCount'));
    }

    public function create()
    {
        return view('admin.dashboard.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            // Tambahkan validasi lainnya sesuai kebutuhan
        ]);

        $room = Room::create($data);

        return redirect()->route('admin.dashboard.index')->with('success', 'Room created successfully.');
    }

    public function show($id)
    {
        $room = Room::find($id);

        if (!$room) {
            return redirect()->route('admin.dashboard.index')->with('error', 'Room not found.');
        }

        return view('admin.dashboard.show', compact('room'));
    }

    public function edit($id)
    {
        $room = Room::find($id);

        if (!$room) {
            return redirect()->route('admin.dashboard.index')->with('error', 'Room not found.');
        }

        return view('admin.dashboard.edit', compact('room'));
    }

    public function update(Request $request, $id)
    {
        $room = Room::find($id);

        if (!$room) {
            return redirect()->route('admin.dashboard.index')->with('error', 'Room not found.');
        }

        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            // Tambahkan validasi lainnya sesuai kebutuhan
        ]);

        $room->update($data);

        return redirect()->route('admin.dashboard.index')->with('success', 'Room updated successfully.');
    }

    public function destroy($id)
    {
        $room = Room::find($id);

        if (!$room) {
            return redirect()->route('admin.dashboard.index')->with('error', 'Room not found.');
        }

        $room->delete();

        return redirect()->route('admin.dashboard.index')->with('success', 'Room deleted successfully.');
    }
}
