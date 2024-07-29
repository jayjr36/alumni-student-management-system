@extends('layout')

@section('content')
<div class="container col-md-6">
    <h5>Your Subscribed Classes</h5>
    @if ($classes->isEmpty())
        <p>No subscribed classes.</p>
    @else
        <ul class="list-group">
            @foreach ($classes as $class)
                <li class="list-group-item">
                    {{ $class->title }}
                    <a href="{{ route('classes.show', $class->id) }}" class="btn btn-info btn-sm float-right">View Subscribers</a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
