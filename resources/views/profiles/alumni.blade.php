@extends('layout')

@section('content')
<div class="container ">
    <div class="card col-7">
        <div class="card-header">
            <h3>{{ $alumni->name }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
            <p><strong>Graduation Year:</strong> {{ $alumni->graduation_year }}</p>
            <p><strong>Degree:</strong> {{ $alumni->degree }}</p>
            <p><strong>Bio:</strong> {{ $alumni->bio }}</p>
            <a href="{{ route('alumni.profile.edit') }}" class="btn btn-primary mb-5">Update Profile</a>

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
                    <button type="submit" class="btn btn-primary">Request to be a Mentor</button>
                </form>
            @endif
        </div>
    </div>

    @if($alumni->mentees->count() > 0)
        <div class="mt-4">
            <h4>Your Mentees</h4>
            <ul class="list-group">
                @foreach($alumni->mentees as $mentee)
                    <li class="list-group-item">
                        {{ $mentee->name }} ({{ $mentee->pivot->status }})
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
@endsection
