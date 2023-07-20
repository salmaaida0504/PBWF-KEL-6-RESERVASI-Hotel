<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facility;

class FacilityController extends Controller
{
    public function index(){
        $facilities = Facility::all();
        return view('admin.facility.index', compact('facilities'));
    }

    public function create(){
        return view('admin.facility.create');
    }

    public function store(Request $request){
        $crud = Facility::create([
            'name' => $request->name,
        ]);

        if ($crud) {
            return redirect()->route('facility.index')->with('status', 'Success');
        } else {
            return redirect()->back()->with('status', 'Failed');
        }
    }

    public function show($id){

    }

    public function edit($id){
        $facility = Facility::findOrFail($id);
        return view('admin.facility.edit', compact('facility'));
    }
    
    public function update(Request $request, $id){
        $facility = Facility::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255',
        ]);

        $facility->update([
            'name' => $request->name,
        ]);

        return redirect()->route('facility.index')->with('status', 'Facility updated successfully.');
    }

    public function destroy($id){
        $facility = Facility::findOrFail($id);

        if ($facility->delete()) {
            return redirect()->route('facility.index')->with('status', 'Success');
        } else {
            return redirect()->route('facility.index')->with('status', 'Failed to delete facility.');
        }
    }

}
