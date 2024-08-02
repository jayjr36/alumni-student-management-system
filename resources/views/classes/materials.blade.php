@extends('layout')

@section('content')
<div class="container col-md-8">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-4">{{ $class->title }} - Materials</h5>
            @if ($class->materials->isEmpty())
                <p class="text-center">No materials available for this class.</p>
            @else
                @foreach ($class->materials as $material)
                    <div class="material-item mb-4">
                        <h6 class="material-title">{{ $material->title }}</h6>
                        
                        @if (Str::endsWith($material->file_path, ['.jpg', '.jpeg', '.png', '.gif']))
                            <img src="{{ asset('storage/'.$material->file_path) }}" alt="Material Image" class="img-fluid max-height-image">
                        @elseif (Str::endsWith($material->file_path, ['.pdf', '.docx', '.txt', '.doc', '.ppt', '.pptx', '.mp4', '.mp3']))
                            <a href="{{ asset('storage/'.$material->file_path) }}" target="_blank" class="btn btn-primary btn-sm">Download</a>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .material-item {
        border-bottom: 1px solid #ddd;
        padding-bottom: 15px;
    }
    
    .material-title {
        font-size: 1.2rem;
        font-weight: bold;
        margin-bottom: 10px;
    }
    
    .img-fluid {
        max-width: 100%;
        height: auto;
    }
    
    .max-height-image {
        max-height: 200px; /* Set your desired max height here */
        object-fit: contain; /* Ensures the image maintains its aspect ratio */
    }
    
    .btn {
        display: block;
        margin-top: 10px;
    }
    
    .card-body {
        padding: 1.5rem;
    }
</style>
@endpush
