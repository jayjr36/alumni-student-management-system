@extends('layout')

@section('content')
    <h1>User Search</h1>
    <form action="{{ route('search') }}" method="GET">
        <input type="text" name="search" placeholder="Search for users">
        <button type="submit">Search</button>
    </form>

    @if(isset($users))
        <h2>Search Results</h2>
        <ul>
            @foreach($users as $user)
                <li>
                    {{ $user->name }}
                    @if($user->id !== auth()->id())
                        <a href="{{ route('chat', ['receiver_id' => $user->id]) }}" class="btn btn-primary">Chat</a>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
@endsection
