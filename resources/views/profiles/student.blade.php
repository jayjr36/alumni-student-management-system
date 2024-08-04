@extends('layout')

@section('content')
<div class="container col-7 py-5">
    <div class="card">
        <div class="card-header text-center">
            <h3>{{ $student->name }}</h3>
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-4 text-center">
                    @if ($student->profile_picture)
                        <img src="{{ asset('images/profile_pictures/'.$student->profile_picture) }}" class="img-fluid rounded-circle"
                            style="max-width: 200px;" alt="Profile Picture">
                    @else
                        <img src="{{ asset('images/default-profile.png') }}" class="img-fluid rounded-circle"
                            style="max-width: 200px;" alt="Default Profile Picture">
                    @endif
                </div>
                <div class="col-md-8">
                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    <p><strong>Current Year:</strong> {{ $student->year ?? '' }}</p>
                    <p><strong>Programme:</strong> {{ $student->major ?? '' }}</p>
                    <p><strong>Bio:</strong> {{ $student->bio ?? '' }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row justify-content-center">
                <a href="{{ route('student.profile.edit') }}" class="btn btn-primary mb-5">Update Profile</a>
            </div>
        </div>
    </div>
</div>
@endsection
