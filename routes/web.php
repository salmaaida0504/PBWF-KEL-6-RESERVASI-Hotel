<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\BookingController;
//use App\Http\Controllers\Admin\FacilityController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/booking/{any}', [HomeController::class, 'create'])->name('home.booking');
Route::post('/book/{id}', [HomeController::class, 'store'])->name('home.store')->middleware(['auth', 'cekrole:user']);
Route::get('/detail', [HomeController::class, 'detail'])->name('home.detail')->middleware(['auth', 'cekrole:user']);
Route::get('/myroom', [HomeController::class, 'myroom'])->name('home.myroom')->middleware(['auth', 'cekrole:user']);
Route::get('/pay/{id}', [HomeController::class, 'pay'])->name('home.pay')->middleware(['auth', 'cekrole:user']);
Route::get('/delete/{id}', [HomeController::class, 'destroy'])->name('home.delete')->middleware(['auth', 'cekrole:user']);

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Admin page
//Route::prefix('/admin')->group(function(){
    //Dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    //Room
	Route::get('/room', [RoomController::class, 'index'])->name('room.index');
	Route::get('/room/create', [RoomController::class, 'create'])->name('room.create');
	Route::post('/room', [RoomController::class, 'store'])->name('room.store');
	Route::get('/room/{room}/edit', [RoomController::class, 'edit'])->name('room.edit');
	Route::put('/room/{room}', [RoomController::class, 'update'])->name('room.update');
	Route::delete('/room/{room}', [RoomController::class, 'destroy'])->name('room.delete');
	Route::get('/room/{room}', [RoomController::class, 'show'])->name('room.show');


    //Facility
	Route::get('/admin/facility', [FacilityController::class, 'index'])->name('facility.index');
	Route::get('/admin/facility/create', [FacilityController::class, 'create'])->name('facility.create');
	Route::post('/admin/facility', [FacilityController::class, 'store'])->name('facility.store');
	Route::get('/admin/facility/{id}/edit', [FacilityController::class, 'edit'])->name('facility.edit');
	Route::post('/admin/facility/{id}', 'FacilityController@update')->name('admin.facility.update');
	Route::delete('/admin/facility/{id}', [FacilityController::class, 'destroy'])->name('facility.destroy');
	Route::get('/facility/{facility}', [RoomController::class, 'show'])->name('facility.show');

    //Booking
    Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
	Route::get('/booking/{id}/delete', [BookingController::class, 'delete'])->name('booking.delete');
//});