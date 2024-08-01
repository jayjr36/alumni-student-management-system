@extends('layout')

@section('content')
<div class="container col-md-8 mt-4">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">My Classes</h5>
            @if ($classes->isEmpty())
                <p class="card-text">You haven't created any classes yet.</p>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Subscribers</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($classes as $class)
                            <tr>
                                <td>{{ $class->title }}</td>
                                <td>{{ $class->description }}</td>
                                <td>{{ $class->subscriptions->count() }}</td>
                                <td>
                                    <a href="{{ route('classes.show', $class->id) }}" class="btn btn-info btn-sm">View Subscribers</a>
                                    <!-- Add other actions if needed -->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
