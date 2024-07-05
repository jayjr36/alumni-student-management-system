@extends('layout')

@section('content')
<div class="container">
    <h4>Pending Mentor Requests</h4>
    <ul class="list-group">
        @foreach($mentorRequests as $request)
            <li class="list-group-item">
                {{ $request->alumni->name }}
                <form action="{{ route('approve.mentor.request', $request->id) }}" method="POST" class="d-inline float-right ml-2">
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm">Approve</button>
                </form>
                <form action="{{ route('reject.mentor.request', $request->id) }}" method="POST" class="d-inline float-right">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>
@endsection
