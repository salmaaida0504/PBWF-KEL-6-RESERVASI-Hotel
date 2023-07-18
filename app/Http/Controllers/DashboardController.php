<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $date = date('Y-m-d H:i:s', strtotime(now()));
        $room = Room::count();
        $booked = Booking::with('room')->orderBy('created_at', 'ASC')->where('check_out', '>=', $date)->count();
        $avalaible = Booking::with('room')->orderBy('created_at', 'ASC')->where('check_out', '<', $date)->count();

        if ($booked == 0) {
            $booked = '0';
        }
        if ($room == 0) {
            $room = '0';
        }
        if ($avalaible == 0) {
            $avalaible = '0';
        }

        return view('admin.dashboard.index', compact('room', 'booked', 'avalaible'))->with('i');
    }

    public function create(){

    }

    public function store(Request $request){

    }

    public function show($id){

    }

    public function edit($id){

    }

    public function update(Request $request, $id){

    }

    public function destroy($id){
        
    }

}
