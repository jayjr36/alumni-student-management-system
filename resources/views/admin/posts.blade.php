@extends('layout')

@section('content')
<div class="container-fluid  py-4">
    <h3 class="mb-4 text-center">Newsfeed</h3>
    <p class="text-center">Be updated with our daily news</p>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="container mt-5">
        <div class="row">
            @foreach ($posts as $post)
                <div class="col-md-12 mb-4">
                    <div class="card h-100 shadow-sm d-flex flex-row" style="transition: transform 0.2s;">
                        @if ($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid" alt="Image" style="width: 500px; height: auto; object-fit: cover;">
                        @endif
                        <div class="card-body d-flex flex-column justify-content-center">
                            <h5 class="card-title" style="font-weight: bold; font-size: 1.25rem;">{{ $post->title }}</h5>
                            <p class="card-text" style="font-size: 1rem; color: #555;">{{ $post->body }}</p>
                        </div>
                        @if(Auth::user()->role != 'student' && Auth::user()->role != 'alumni')
                            <div class="card-footer d-flex flex-column justify-content-around" style="background-color: #f8f9fa;">
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary btn-sm mb-2" style="background-color: #007bff; border: none;">Edit</a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" style="background-color: #dc3545; border: none;">Delete</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.card').hover(function() {
                $(this).css('transform', 'scale(1.05)');
            }, function() {
                $(this).css('transform', 'scale(1)');
            });
        });
    </script>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
@endsection
