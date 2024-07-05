<!-- resources/views/alumni/edit-profile.blade.php -->

@extends('layout') <!-- Assuming you have a layout template -->

@section('content')
    <div class="card">
        <div class="card-body">
            <h3>Edit Profile</h3>
            <form action="{{ route('alumni.profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="graduation_year">Graduation Year</label>
                    <input type="text" id="graduation_year" name="graduation_year" class="form-control" value="{{ $alumni->graduation_year ?? '' }}">
                </div>

                <div class="form-group">
                    <label for="degree">Degree</label>
                    <input type="text" id="degree" name="degree" class="form-control" value="{{ $alumni->degree ?? ''}}">
                </div>

                <div class="form-group">
                    <label for="bio">Bio</label>
                    <textarea id="bio" name="bio" class="form-control">{{ $alumni->bio ?? ''}}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </div>
@endsection
