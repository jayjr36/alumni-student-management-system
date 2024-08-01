@extends('layout')

@section('content')
<div class="container col-8">
    <h3>Classes</h3>
    @if ($classes->isEmpty())
        <p>No classes available from this mentor.</p>
    @else
        <ul class="list-group">
            @foreach ($classes as $class)
                <li class="list-group-item">
                    <h5>{{ $class->title }}</h5>
                    <p>{{ $class->description }}</p>
                    <form action="{{ route('classes.subscribe', $class->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm">Subscribe</button>
                    </form>
                    @if ($class->subscribers->isNotEmpty())
                        <ul>
                            @foreach ($class->subscribers as $subscriber)
                                <li>{{ $subscriber->name }}</li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection