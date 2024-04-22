@extends('layout')

@section('content')
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-light">
        <div class="container">
          <a class="navbar-brand" href="#">Student & Alumni Platform</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('interaction')}}">Interaction</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#mentorship">Mentorship</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#chat">Chat</a>
              </li>
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
      
      <section class=" text-center py-5" style="height: 100vh">
        <div class="container-fluid">
          <h1 class="display-4">Welcome to Student & Alumni Platform</h1>
          <p class="lead">Connect, learn, and grow together</p>
          <img src="https://via.placeholder.com/150" alt="Platform Logo" class="img-fluid rounded-circle">
        </div>
      </section>
      
      <!-- Interaction Section -->
      <section id="interaction" class="py-5">
        <div class="container text-center">
          <div class="row">
            <div class="col-md-4">
              <div class="feature-box">
                <i class="fa fa-comments feature-icon mb-4"></i>
                <h2 class="feature-text">Interaction</h2>
                <p class="lead">Engage with fellow students and alumni in discussions, forums, and groups.</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="feature-box">
                <i class="fa fa-graduation-cap feature-icon mb-4"></i>
                <h2 class="feature-text">Mentorship</h2>
                <p class="lead">Offer mentorship to current students and provide guidance in their journey.</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="feature-box">
                <i class="fa fa-comments feature-icon mb-4"></i>
                <h2 class="feature-text">Chat</h2>
                <p class="lead">Connect with other members in real-time through our chat feature.</p>
              </div>
            </div>
          </div>
        </div>
      </section>
      
      
</div>
@endsection
