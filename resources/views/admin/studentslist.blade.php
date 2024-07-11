@extends('layout')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4">Students List</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $student->name }}</td>
                    <td>
                        <a href="{{ route('students.profile', $student->id) }}" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#profileModal{{ $student->id }}">View Profile</a>
                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete {{ $student->name }}?')">Delete</button>
                        </form>
                    </td>
                </tr>

                <!-- Profile Modal -->
                <div class="modal fade" id="profileModal{{ $student->id }}" tabindex="-1" aria-labelledby="profileModalLabel{{ $student->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="profileModalLabel{{ $student->id }}">{{ $student->name }}'s Profile</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Name:</strong> {{ $student->name }}</p>
                                <p><strong>Registration Number:</strong> {{ $student->regNumber }}</p>
                                <!-- Add more profile details as needed -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Profile Modal -->
            @endforeach
        </tbody>
    </table>
</div>
@endsection