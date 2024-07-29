@extends('layout')

@section('content')
<div class="container col-md-6">
    <h5>Create a New Class</h5>
    <form action="{{ route('classes.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Class Title</label>
            <input type="text" name="title" class="form-control" id="title" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" id="description"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create Class</button>
    </form>
</div>
@endsection
