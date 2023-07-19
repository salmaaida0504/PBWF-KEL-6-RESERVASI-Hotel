@extends('layouts.app')

@section('content')

<section id="jumbotron" class="w-100 bg-primary py-5">
    <div class="container py-5 text-white my-5">
        <div class="col p-0 m-0" style="max-width:470px">
            <h2 style="line-height:1.5em">Visit Paradise Here With SQ Hotel</h2>
            <h2 style="line-height:1.5em">We Respect Your Living</h2>
            <p class="my-4">
                Selamat datang di Hotel Blue Horizon!
                Hotel Blue Horizon adalah destinasi pilihan untuk menginap yang menggabungkan kenyamanan dan keindahan. Terletak di jantung kota,
                hotel kami menawarkan akses mudah ke tempat-tempat wisata terkenal, restoran, dan pusat perbelanjaan.
            </p>
            <a class="btn bg-white text-primary" href="#room">Get Started</a>
        </div>
    </div>
</section>
<section id="room" class="py-5 my-5 bg-white">
    <div class="container mb-5">
        <div class="row">
            @foreach($room as $r)
            <div class="card shadow p-0 col-4 my-3">
                <img src="{{ asset('img/' . $r->image) }}" width="100%" height="230">
                <div class="form-inline p-3">
                    <span class="btn btn-sm mr-1 btn-outline-primary">{{ $r->quantity }} Person</span>
                    <span class="btn btn-sm mr-1 btn-outline-primary">{{ $r->type }} Room</span>
                    <span class="btn btn-sm btn-outline-primary">{{ $r->class }} Class</span>
                </div>
                <h2 style="font-size:17px;line-height:1.6em;margin-top:-10px" class="p-3 pb-0 mb-0">
                    <a href="{{ route('home.booking', $r->slug) }}">{{ $r->name }}</a>
                </h2>
                <?php 
                    $b = DB::table('bookings')->orderBy('created_at', 'DESC')->where('room_id', $r->id)->first();
                    $count = DB::table('bookings')->orderBy('created_at', 'DESC')->where('room_id', $r->id)->count();
                ?>
                @if($count < 1)
                <p class="px-3">Available - Rp {{ $r->price }}/day</p>
                @if($b && $b->check_out > now())
                <p class="px-3">Available - Rp {{ $r->price }}/day</p>
                @endif
                @else
                <p class="px-3">Booked - Rp {{ $r->price }}/day</p>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
