@extends('layout')

@section('content')
<div class="container py-5 col-6">
    <h1>Edit Student Profile</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $student->name }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="regNumber">Registration Number</label>
            <input type="text" class="form-control" id="regNumber" name="regNumber" value="{{ $student->regNumber }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="year">Year</label>
            <input type="number" class="form-control" id="year" name="year" value="{{ $student->year }}">
        </div>

        <div class="form-group mb-3">
            <label for="major">Major</label>
            <input type="text" class="form-control" id="major" name="major" value="{{ $student->major }}">
        </div>

        <div class="form-group mb-3">
            <label for="bio">Bio</label>
            <textarea class="form-control" id="bio" name="bio">{{ $student->bio }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label for="profile_picture">Profile Picture</label>
            <input type="file" class="form-control" id="profile_picture" name="profile_picture">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
