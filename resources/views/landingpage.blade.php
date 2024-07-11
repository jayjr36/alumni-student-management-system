@extends('layout')

@section('content')
<div class="container">
    <!-- Welcome Section -->
    <section class="text-center py-5 bg-light">
        <div class="container">
            <h1 class="display-4 text-primary font-weight-bold">Welcome to Student & Alumni Platform</h1>
            <p class="lead text-secondary mb-4">Connect, learn, and grow together</p>
            <img src="{{ asset('images/mentorship2.png') }}" alt="Platform Logo" class="img-fluid rounded-circle mb-4 shadow">
        </div>
    </section>

    <!-- Features Section -->
    <section id="interaction" class="py-5">
        <div class="container">
            <div class="row text-center">
                <!-- Interaction Feature -->
                <div class="col-md-4 mb-4">
                    <div class="feature-box p-4 bg-white shadow rounded">
                        <i class="fa fa-comments feature-icon mb-4 text-primary" style="font-size: 3rem;"></i>
                        <h2 class="feature-text font-weight-bold text-dark">Interaction</h2>
                        <p class="lead text-muted">Engage with fellow students and alumni in discussions, forums, and groups.</p>
                    </div>
                </div>
                <!-- Mentorship Feature -->
                <div class="col-md-4 mb-4">
                    <div class="feature-box p-4 bg-white shadow rounded">
                        <i class="fa fa-graduation-cap feature-icon mb-4 text-primary" style="font-size: 3rem;"></i>
                        <h2 class="feature-text font-weight-bold text-dark">Mentorship</h2>
                        <p class="lead text-muted">Offer mentorship to current students and provide guidance in their journey.</p>
                    </div>
                </div>
                <!-- Chat Feature -->
                <div class="col-md-4 mb-4">
                    <div class="feature-box p-4 bg-white shadow rounded">
                        <i class="fa fa-comments feature-icon mb-4 text-primary" style="font-size: 3rem;"></i>
                        <h2 class="feature-text font-weight-bold text-dark">Chat</h2>
                        <p class="lead text-muted">Connect with other members in real-time through our chat feature.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
