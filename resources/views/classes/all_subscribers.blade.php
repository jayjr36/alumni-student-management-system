@extends('layout')

@section('content')
<div class="container col-md-6">
    <h5>Subscribers for "{{ $class->title }}"</h5>
    @if ($subscribers->isEmpty())
        <p>No subscribers for this class.</p>
    @else
        <ul class="list-group">
            @foreach ($subscribers as $subscription)
                <li class="list-group-item">
                    {{ $subscription->student->name }}
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
