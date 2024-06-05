@extends('layout')

@section('content')
<div class="container">
    <section class="text-center py-5">
        <div class="container">
            <h1 class="display-4">Welcome to Student & Alumni Platform</h1>
            <p class="lead">Connect, learn, and grow together</p>
            <img src="https://via.placeholder.com/150" alt="Platform Logo" class="img-fluid rounded-circle">
        </div>
    </section>

    <section id="interaction" class="py-5">
        <div class="container">
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
