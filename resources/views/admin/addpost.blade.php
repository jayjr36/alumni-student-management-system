@extends('layout')

@section('content')
<div class="container py-5">
    <h3 class="display-5 text-center fw-bold mb-4">Post to Newsfeed</h3>

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

    <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" aria-label="Title" required>
                </div>
                
                <div class="mb-3">
                    <label for="body" class="form-label">Content</label>
                    <textarea class="form-control" id="body" name="body" style="height: 150px" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>

                <div class="d-grid">
                    <button class="btn btn-primary btn-lg" type="submit">CREATE POST</button>
                </div>
            </div>
        </div>
    </form>

    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
@endsection
