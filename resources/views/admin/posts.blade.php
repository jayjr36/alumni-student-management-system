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

    <div class="row">
        @foreach ($posts as $post)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ $post->title }}</h5>
                        <p class="card-text text-center">{{ $post->body }}</p>
                    </div>
                    @if(Auth::user()->role != 'student' && Auth::user()->role != 'alumni')
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm">
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            </div>
                            <div class="col-sm">
                                <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

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
