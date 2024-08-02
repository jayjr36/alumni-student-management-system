@extends('layout')

@section('content')
<div class="container col-md-8">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $class->title }} - Materials</h5>
            @if ($class->materials->isEmpty())
                <p>No materials available for this class.</p>
            @else
                <ul class="list-group">
                    @foreach ($class->materials as $material)
    <li class="list-group-item">
        <strong>{{ $material->title }}</strong>
        
        @if (Str::endsWith($material->file_path, ['.jpg', '.jpeg', '.png', '.gif']))
            <img src="{{ asset('storage/' . $material->file_path) }}" alt="Material Image">
        @elseif (Str::endsWith($material->file_path, ['.pdf', '.docx', '.txt', '.doc', '.ppt', '.pptx', '.mp4', '.mp3']))
            <a href="{{ asset('storage/' . $material->file_path) }}" target="_blank" class="btn btn-primary btn-sm ml-2">Download</a>
        @endif
    </li>
@endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
@endsection
