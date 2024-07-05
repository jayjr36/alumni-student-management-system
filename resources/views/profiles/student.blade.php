@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card col-7">
        <div class="card-header">
            <h3>{{ $student->name }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Email:</strong> {{ $student->email ?? ''}}</p>
            <p><strong>Year:</strong> {{ $student->year ?? ''}}</p>
            <p><strong>Major:</strong> {{ $student->major ?? ''}}</p>
            <p><strong>Bio:</strong> {{ $student->bio ?? ''}}</p>
        </div>
        <a href="{{ route('student.profile.edit') }}" class="btn btn-primary  mb-5">Update Profile</a>
       
    </div>

    @if($mentors->count() > 0)
        <div class="mt-4">
            <h4>Your Mentors</h4>
            <ul class="list-group">
                @foreach($mentors as $mentor)
                    <li class="list-group-item">
                        {{ $mentor->name }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mt-4">
        <h4>Available Mentors</h4>
        <ul class="list-group">
            @foreach(\App\Models\Alumni::whereHas('mentorRequests', function ($query) {
                $query->where('status', 'approved');
            })->get() as $mentor)
                <li class="list-group-item">
                    {{ $mentor->name }}
                    <form action="{{ route('request.mentorship', ['mentor_id' => $mentor->id, 'student_id' => $student->id]) }}" method="POST" class="d-inline float-right">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">Request Mentorship</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
