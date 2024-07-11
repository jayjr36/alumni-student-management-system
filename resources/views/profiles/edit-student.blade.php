@extends('layout')

@section('content')
<div class="container col-7 py-5">
    <div class="card">
        <div class="card-header text-center">
            <h3>{{ Auth::user()->name }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('student.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ Auth::user()->email ?? '' }}">
                </div>
                
                <div class="form-group">
                    <label for="year">Current Year</label>
                    <input type="text" id="year" name="year" class="form-control" value="{{ $student->year ?? '' }}">
                </div>

                <div class="form-group">
                    <label for="major">Programme</label>
                    <input type="text" id="major" name="major" class="form-control" value="{{ $student->major ?? '' }}">
                </div>

                <div class="form-group">
                    <label for="bio">Bio</label>
                    <textarea id="bio" name="bio" class="form-control">{{ $student->bio ?? '' }}</textarea>
                </div>

                <div class="form-group">
                    <label for="profile_picture">Profile Picture</label>
                    <input type="file" id="profile_picture" name="profile_picture" class="form-control-file">
                </div>

                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </div>
</div>
@endsection
