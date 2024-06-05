@extends('layout')

@section('content')
<div class="container">    <header>
    <nav style="display: flex; justify-content: center;">
        <ul style="display: flex; list-style-type: none; padding: 0;">
            @if (auth()->check())
                @if (auth()->user()->role == 'student')
                    <li style="margin-right: 10px;"><a class="btn btn-secondary btn-sm" target="content-iframe" href="{{ route('mentorship_offers.index') }}">View Mentorship Offers</a></li>
                @elseif (auth()->user()->role == 'alumni')
                    <li style="margin-right: 10px;"><a class="btn btn-secondary btn-sm" target="content-iframe" href="{{ route('mentorship_offers.create') }}">Post Mentorship Offer</a></li>
                    <li style="margin-right: 10px;"><a class="btn btn-secondary btn-sm" target="content-iframe" href="{{ route('mentorship_requests.new') }}">New Mentorship Requests</a></li>
               
                    @endif
            @endif
        </ul>
    </nav>
    
    </header>
    <div class="iframe-container" style="margin-top: 86px;"> 
        <iframe id="content-iframe" name="content-iframe" src="/mentorship-offers" frameborder="0" style="width: 100%; height: calc(100vh - 10vh);"></iframe>
    </div>
</div>

@endsection