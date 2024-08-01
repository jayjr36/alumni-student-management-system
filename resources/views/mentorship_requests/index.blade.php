@extends('layout')

@section('content')
    <div class="container col-md-6">
        <div class="row py-3">
            <div class="col text-center">
                <a href="{{route('classes.create')}}" class="btn btn-info">CREATE CLASS</a>
            </div>
            <div class="col text-center">

                <a href="{{route('classes.index')}}" class="btn btn-info">SUBSCRIBERS</a>
            </div>
        </div>
        <div class="card">
          

            <div class="card-body">
                <h5 class="card-title">Mentorship Requests</h5>
                @if ($mentorshipRequests->isEmpty())
                    <p class="card-text">No mentorship requests.</p>
                @else
                    <ul class="list-group list-group-flush">
                        @foreach ($mentorshipRequests as $mentorshipRequest)
                            <li class="list-group-item">
                                <span>{{ $mentorshipRequest->student_name }} requested mentorship.</span>
                              
                                @if ($mentorshipRequest->status === 'pending')
                                    <form action="{{ route('mentorship_requests.accept', $mentorshipRequest->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm mx-2">Accept</button>
                                    </form>
                                    <form action="{{ route('mentorship_requests.reject', $mentorshipRequest->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                    </form>
                                @elseif ($mentorshipRequest->status === 'accepted')
                                    <span class="badge bg-success">Accepted</span>
                                @elseif ($mentorshipRequest->status === 'rejected')
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

    </div>
@endsection
