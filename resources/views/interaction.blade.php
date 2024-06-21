@extends('layout')

@section('content')
    <div class="container col-5 mt-4">
        <h3 class="text-center">User Search</h3>
        <form action="{{ route('search') }}" method="GET" class="form-inline justify-content-center mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search for users">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>

        @if(isset($users))
            <h3 class="col-5 text-center">Search Results</h3>
            <ul class="list-group">
                @foreach($users as $user)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $user->name }}
                        @if($user->id !== auth()->id())
                            <a href="{{ route('chat', ['receiver_id' => $user->id]) }}" class="btn btn-primary btn-sm">Chat</a>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection

