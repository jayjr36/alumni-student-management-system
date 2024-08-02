@extends('layout')

@section('content')
<div class="container">
    <div class="row py-3">
        <div class="col text-center">
            <a href="{{route('classes.create')}}" class="btn btn-info">CREATE CLASS</a>
        </div>
        <div class="col text-center">

            <a href="{{route('classes.index')}}" class="btn btn-info">SUBSCRIBERS</a>
        </div>
    </div>

    <div class="container">
        <form action="{{ route('materials.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Material Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="file">Upload File</label>
                <input type="file" class="form-control" id="file" name="file" required>
            </div>
            <div class="form-group">
                <label for="class_id">Select Class</label>
                <select class="form-control" id="class_id" name="class_id" required>
                    <option value="" disabled selected>Select a class</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}">{{ $class->title }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
    
</div>

@endsection