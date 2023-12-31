@extends('layouts.app')

@section('content')
<div class="container mt-5 pt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="float-left pt-2">Facilities Management</h5>
                    <a class="btn btn-primary float-right" href="{{ route('facility.create') }}">New Facility</a>
                </div>

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
            <th>Action</th>
        </tr>
        @foreach($facilities as $facility)
        <tr>
            <td class="pt-3">{{ $loop->index + 1 }}</td>
            <td class="pt-3">{{ $facility->name }}</td>
            <td>
                <a class="btn btn-success mr-2" href="{{ route('facility.edit', $facility->id) }}">Edit</a>
                <form action="{{ route('facility.destroy', $facility->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this facility?')">Delete</button>
                </form>
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
