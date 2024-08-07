@extends('layout')

@section('content')
<div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">Student & Alumni Platform</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('landingpage') }}" target="content-iframe">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('interaction') }}" target="content-iframe">Interaction</a>
                    </li>
                    @if (auth()->check() && auth()->user()->role == 'student')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('student.mentorship', ['id' => auth()->user()->guest_id]) }}" target="content-iframe">Mentorship</a>
                    </li>
                    @endif
                    @if (auth()->check() && auth()->user()->role == 'alumni')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('alumni.mentorship', ['id' => auth()->user()->guest_id]) }}" target="content-iframe">Mentorship</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('recent.contacts') }}" target="content-iframe">Chat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('posts.index') }}" target="content-iframe">NewsFeed</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('forum.index') }}" target="content-iframe">Forum</a>
                    </li>
                    @if (auth()->user()->role == 'alumni')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('alumni_profile', ['id' => auth()->user()->guest_id]) }}" target="content-iframe">Profile</a>
                    </li>
                    @elseif (auth()->user()->role == 'student')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('student_profile', ['id' => auth()->user()->guest_id]) }}" target="content-iframe">Profile</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="iframe-container" style="margin-top: 56px;"> <!-- Adjust margin-top to match navbar height -->
        <iframe id="content-iframe" name="content-iframe" src="{{ route('landingpage') }}" frameborder="0"
            style="width: 100%; height: calc(100vh - 56px);"></iframe>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection
