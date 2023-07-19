<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facility;

class FacilityController extends Controller
{
    //
    public function index(){
        $facilities = Facility::all();
    return view('facility.index', compact('facilities'));
    }

    public function create(){
        return view('admin.facility.create')->with('i');
    }

    public function store(Request $request){
       $crud = Facility::create([
        'name' => $request->name,
       ]);

       if($crud){
        return redirect()->route('facility')->with('status', 'Success');
       } else {
        return redirect()->back()->with('status', 'Failed');
       }
    }

    public function show($id){

    }

    public function edit($id){
        $facility = Facility::findOrFail($id);
        return view('facility.edit', compact('facility'));
    }
    
    public function update(Request $request, $id){
        $facility = Facility::findOrFail($id);
        $crud = $facility->update([
            'name' => $request->name,
        ]);

        if($crud){
            return redirect()->route('facility')->with('status', 'Success');
        } else {
            return redirect()->back()->with('status', 'Failed');
        }
    }

    public function destroy($id){
        $facility = Facility::findOrFail($id);
        $crud = $facility->delete();

        if($crud){
            return redirect()->route('facility')->with('status', 'Success');
        }
    }

}
