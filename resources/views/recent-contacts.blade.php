@extends('layout')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Recent Contacts</h1>
    <div class="list-group">
        @foreach($recentContacts as $contact)
            <a href="{{ route('chat', ['receiver_id' => $contact->id]) }}" class="list-group-item list-group-item-action">
                {{ $contact->name }}
            </a>
        @endforeach
    </div>
</div>
@endsection
