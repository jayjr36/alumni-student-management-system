@extends('layout')

@section('content')
<div class="container-fluid bg-dark text-white" style="height: 100vh;">
        <h2 class="display-5 text-center fw-bold">Post to Newsfeed</h2>

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

            <div class="card bg-dark text-white py-5">
                <div class="col-md-8 offset-md-2">
                    <div class="col p-2">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" aria-label="Title" name="title">
                    </div>
                </div>

                <div class="col-md-8 offset-md-2">
                    <label for="body">Content</label>
                    <textarea class="form-control mx-auto p-2" id="body" name="body" style="height: 100px"></textarea>
                </div>
                <div class="d-grid gap-2 col-6 mx-auto mt-5">
                    <button class="btn btn-primary" type="submit">CREATE POST</button>
                </div>
            </div>
        </form>

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
