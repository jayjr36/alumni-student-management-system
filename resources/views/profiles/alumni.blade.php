@extends('layout')

@section('content')
<div class="container col-7">
    <div class="card col-7">
        <div class="card-header">
            <h3 class="text-center">{{ $alumni->name }}</h3>
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-4 text-center">
                    @if ($alumni->profile_picture)
                        <img src="{{ asset('storage/' . $alumni->profile_picture) }}" class="img-fluid rounded-circle"
                            style="max-width: 200px;" alt="Profile Picture">
                    @else
                        <img src="{{ asset('images/default-profile.png') }}" class="img-fluid rounded-circle"
                            style="max-width: 200px;" alt="Default Profile Picture">
                    @endif
                </div>
                <div class="col-md-8">
                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    <p><strong>Graduation Year:</strong> {{ $alumni->graduation_year }}</p>
                    <p><strong>Degree:</strong> {{ $alumni->degree }}</p>
                    <p><strong>Bio:</strong> {{ $alumni->bio }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row justify-content-center">
                <a href="{{ route('alumni.profile.edit') }}" class="btn btn-primary mb-5">Update Profile</a>
            </div>
        </div>
    </div>
</div>

<div class="container col-7">
    
@if($mentorRequest)
@if($mentorRequest->status == 'pending')
    <p><strong>Status:</strong> Mentor request pending approval.</p>
@elseif($mentorRequest->status == 'approved')
    <p><strong>Status:</strong> You are an approved mentor.</p>
@else
    <p><strong>Status:</strong> Mentor request rejected.</p>
@endif
@else
<form action="{{ route('request.mentor', $alumni->id) }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-success">Request to be a Mentor</button>
</form>
@endif

</div>
@endsection
