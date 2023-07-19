@extends('layouts.app')

@section('content')
<div class="container mt-5 pt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Room</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="post" enctype="multipart/form-data" action="{{ route('room.update', $room->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $room->name }}">
                        </div>
                        <div class="form-group">
                            <label for="img">Image</label>
                            <label for="img"><img height="350" width="100%" src="{{ asset('img/'.$room->image) }}"></label>
                            <input type="file" id="img" name="image" class="form-control p-1">
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" name="price" id="price" class="form-control" value="{{ $room->price }}">
                        </div>
                        <div class="form-group">
                            <label>Facilities</label>
                            <div class="border p-2">
                                @foreach($facilities as $facility)
                                <input type="checkbox" name="facility_id[]" class="my-2 mr-1" value="{{ $facility->id }}" {{ in_array($facility->id, $selectedFacilities) ? 'checked' : '' }}> {{ $facility->name }}<br>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <select name="quantity" id="quantity" class="form-control">
                                @for($j=1; $j<=5; $j++)
                                <option value="{{ $j }}" {{ $room->quantity == $j ? 'selected' : '' }}>{{ $j }} Person</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="type">Type</label>
                            <select name="type" id="type" class="form-control">
                                <option value="Personal" {{ $room->type == 'Personal' ? 'selected' : '' }}>Personal</option>
                                <option value="Couple" {{ $room->type == 'Couple' ? 'selected' : '' }}>Couple</option>
                                <option value="Family" {{ $room->type == 'Family' ? 'selected' : '' }}>Family</option>
                                <option value="Small" {{ $room->type == 'Small' ? 'selected' : '' }}>Small</option>
                                <option value="Medium" {{ $room->type == 'Medium' ? 'selected' : '' }}>Medium</option>
                                <option value="Large" {{ $room->type == 'Large' ? 'selected' : '' }}>Large</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="class">Class</label>
                            <select name="class" id="class" class="form-control">
                                <option value="S" {{ $room->class == 'S' ? 'selected' : '' }}>S</option>
                                <option value="A" {{ $room->class == 'A' ? 'selected' : '' }}>A</option>
                                <option value="B" {{ $room->class == 'B' ? 'selected' : '' }}>B</option>
                                <option value="C" {{ $room->class == 'C' ? 'selected' : '' }}>C</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <a href="{{ route('room.index') }}" class="btn btn-outline-primary mr-2">Back</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
