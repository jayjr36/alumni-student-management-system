<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Alumni & Student Interaction Platform</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #343a40;
        }
        .navbar-brand {
            color: #ffffff !important;
        }
        .card {
            transition: transform 0.2s;
        }
        .card:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<!-- Main Content -->
<div class="container mt-5">
    <div class="row">
        <div class="col text-center">
            <h1 class="display-4">Welcome to the Admin Panel</h1>
            <p class="lead">Manage the platform efficiently and keep everything up to date.</p>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <i class="bi bi-house-door display-1 text-primary"></i>
                    <h5 class="card-title mt-3">Newsfeed</h5>
                    <p class="card-text">Manage and update the latest news and announcements.</p>
                    <a href="{{ route('posts.index') }}" class="btn btn-primary">Go to Newsfeed</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <i class="bi bi-people display-1 text-success"></i>
                    <h5 class="card-title mt-3">Students</h5>
                    <p class="card-text">View and manage student profiles and activities.</p>
                    <a href="{{ route('students.index') }}" class="btn btn-success">Manage Students</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <i class="bi bi-person-badge display-1 text-info"></i>
                    <h5 class="card-title mt-3">Alumni</h5>
                    <p class="card-text">Connect and manage alumni profiles and events.</p>
                    <a href="{{ route('alumni.index') }}" class="btn btn-info">Manage Alumni</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <i class="bi bi-person-plus display-1 text-warning"></i>
                    <h5 class="card-title mt-3">Add Students</h5>
                    <p class="card-text">Add new student profiles to the platform.</p>
                    <a href="{{ route('students.create') }}" class="btn btn-warning text-white">Add Students</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <i class="bi bi-person-plus-fill display-1 text-danger"></i>
                    <h5 class="card-title mt-3">Add Alumni</h5>
                    <p class="card-text">Add new alumni profiles to the platform.</p>
                    <a href="{{ route('alumni.create') }}" class="btn btn-danger">Add Alumni</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <i class="bi bi-file-earmark-post display-1 text-secondary"></i>
                    <h5 class="card-title mt-3">Post to Newsfeed</h5>
                    <p class="card-text">Create and publish new posts to the newsfeed.</p>
                    <a href="{{ route('post.create') }}" class="btn btn-secondary">Create Post</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
