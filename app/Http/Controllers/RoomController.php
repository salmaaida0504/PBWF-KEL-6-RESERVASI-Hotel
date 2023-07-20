<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Facility;
use App\Models\Feature;
use Illuminate\Support\Str;

class RoomController extends Controller
{

    private function generateSlug($name)
    {
        // Gunakan method slug() dari class Str untuk membuat slug dari nama
        $slug = Str::slug($name, '-');
        
        // Cek apakah slug sudah ada dalam database, jika ya, tambahkan angka di belakangnya
        $count = 1;
        while (Room::where('slug', $slug)->exists()) {
            $slug = Str::slug($name, '-') . '-' . $count;
            $count++;
        }
        
        return $slug;
    }

    public function index(){
        $rooms = Room::all(); // Mengambil semua data kamar dari tabel "rooms"
        return view('admin.room.index', compact('rooms'));
        
        // $room = Room::latest()->get();
        // return view('admin.room.index', compact('room'))->with('i');
    }

    public function create(){
        $facilities = Facility::all();
        return view('admin.room.create', compact('facilities'));
    }

    public function store(Request $request)
{
    // Generate slug
    $slug = $this->generateSlug($request->name);

    $image = null; // Inisialisasi $image dengan nilai awal null

    // Jika ada file gambar di request, pindahkan ke folder public/img
    if ($request->hasFile('image')) {
        $img = $request->file('image');
        $image = $img->getClientOriginalName();
        $img->move(public_path('/img'), $image);
    }

    // Buat data room baru
    $room = Room::create([
        'name' => $request->name,
        'slug' => $slug,
        'image' => $image,
        'price' => $request->price,
        'quantity' => $request->quantity,
        'type' => $request->type,
        'class' => $request->class,
    ]);

    if ($room) {
        // Jika room berhasil dibuat, tambahkan fitur-fitur ke room
        $facilities = Facility::all();
        foreach ($facilities as $facility) {
            $status = $request->has('facility_id' . $facility->id) ? 1 : 0;
            $feature = Feature::create([
                'room_id' => $room->id,
                'facility_id' => $facility->id,
                'status' => $status,
            ]);
        }
        return redirect()->route('room.index')->with('status', 'Success');
    } else {
        return redirect()->back()->with('status', 'Failed');
    }
}

    public function show($id){
        //
    }

    public function edit($id){
        $room = Room::findOrFail($id);
    $facilities = Facility::all();

    // Periksa apakah $room memiliki relasi dengan features sebelum menggunakan pluck()
    $selectedFacilities = $room->features ? $room->features->pluck('facility_id')->toArray() : [];

    return view('admin.room.edit', compact('room', 'facilities', 'selectedFacilities'));
    }

    public function update(Request $request, $id)
{
    $slug = str_replace(' ', '-', strtolower($request->name));
    $room = Room::findOrFail($id);

    try {
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $image = $img->getClientOriginalName();
            $img->move(public_path('/img'), $image);

            $crud = $room->update([
                'name' => $request->name,
                'slug' => $slug, // Update slug juga jika nama berubah
                'image' => $image,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'type' => $request->type,
                'class' => $request->class,
            ]);
        } else {
            $crud = $room->update([
                'name' => $request->name,
                'slug' => $slug, // Update slug juga jika nama berubah
                'price' => $request->price,
                'quantity' => $request->quantity,
                'type' => $request->type,
                'class' => $request->class,
            ]);
        }

        // Inisialisasi $crud2 sebelum loop dimulai
        $crud2 = true;

        $fac = Facility::orderBy('name', 'ASC')->get();
        $count = $fac->count();

        $i = 1;

        foreach ($fac as $f) {
            $facility_id = $request->input('facility_id' . $i);
            // Pastikan facility_id tidak bernilai null sebelum membuat atau mengupdate fitur
            if ($facility_id !== null) {
                $feature = Feature::where('room_id', $id)->where('facility_id', $facility_id)->first();
        
                if ($feature == null) {
                    // Jika fitur belum ada, buat baru
                    $crud2 = Feature::create([
                        'room_id' => $id,
                        'facility_id' => $facility_id,
                        'status' => 1, // Jika id fasilitas tidak kosong, set status 1
                    ]);
                } else {
                    // Jika fitur sudah ada, update status
                    $crud2 = $feature->update([
                        'status' => 1, // Set status 1
                    ]);
                }
            }
            $i++;
        }

        if ($crud && $crud2) {
            return redirect()->route('room.index')->with('status', 'Success');
        } else {
            return redirect()->back()->with('status', 'Failed to update room features.');
        }
    } catch (QueryException $e) {
        // Handle database query exception, if any
        return redirect()->back()->with('status', 'Failed to update room. Please check your input.');
    }
}

    public function destroy($id){
        $room = Room::findOrFail($id);
        $feature = Feature::where('room_id', $id);
        $crud = $feature->delete();
        $crud2 = $room->delete();
        
        if ($crud2) {
            return redirect()->route('room.create');
        }
    }

}