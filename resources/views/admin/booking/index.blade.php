@extends('layouts.app')

@section('content')
<div class="container mt-5 pt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h5 class="float-left pt-2">Bookings Management</h5></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif                    

                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Check In</th>
                                <th>Check Out</th>
                                <th>Action</th>
                            </tr>
                            @foreach($bookings as $booking)
                            <tr>
                                <td class="pt-3">{{ ++$loop->index }}</td>
                                <td class="pt-3">{{ $booking->room->name }}</td>
                                <td class="pt-3">{{ date('d F Y', strtotime($booking->check_in)) }}</td>
                                <td class="pt-3">{{ date('d F Y', strtotime($booking->check_out)) }}</td>
                                <td>
                                    @if($booking->check_out > now())
                                    <p class="btn btn-success">Booked</p>
                                    @else
                                    <a class="btn btn-danger" href="{{ route('booking.delete', $booking->id) }}">Delete</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
