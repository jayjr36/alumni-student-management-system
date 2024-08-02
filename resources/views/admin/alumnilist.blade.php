@extends('layout')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4">Alumni List</h1>

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
                <th>Registration Number</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($alumni as $alumnus)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $alumnus->name }}</td>
                <td>{{ $alumnus->regNumber }}</td>
                <td>
                    <button class="btn btn-primary btn-sm view-profile" data-id="{{ $alumnus->id }}" data-bs-toggle="modal" data-bs-target="#profileModal{{ $alumnus->id }}">View Profile</button>
            
                    <a href="{{ route('alumni.edit', $alumnus->id) }}" class="btn btn-warning btn-sm">Edit</a>
            
                    <form action="{{ route('alumni.destroy', $alumnus->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete {{ $alumnus->name }}?')">Delete</button>
                    </form>
                </td>
            </tr>
            
                <!-- Profile Modal -->
                <div class="modal fade" id="profileModal{{ $alumnus->id }}" tabindex="-1" aria-labelledby="profileModalLabel{{ $alumnus->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="profileModalLabel{{ $alumnus->id }}">{{ $alumnus->name }}'s Profile</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @if ($alumnus->profile_picture)
                                <p><strong>Profile Picture:</strong></p>
                                <img src="{{ asset('storage/' . $alumnus->profile_picture) }}" alt="{{ $alumnus->name }}'s Profile Picture" class="img-fluid">
                            @endif

                                <p><strong>Name:</strong> {{ $alumnus->name }}</p>
                                <p><strong>Registration Number:</strong> {{ $alumnus->regNumber }}</p>
                                <p><strong>Graduation Year:</strong> {{ $alumnus->graduation_year }}</p>
                                <p><strong>Programme:</strong> {{ $alumnus->degree }}</p>
                                <p><strong>Bio:</strong> {{ $alumnus->bio }}</p>
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

<meta name="csrf-token" content="{{ csrf_token() }}">
{{-- 
<script>
    var alumniShowUrl = '{{ route('alumni.show', ['id' => ':id']) }}';
</script> --}}

<script>
    $(document).ready(function() {
        $('.view-profile').on('click', function() {
            var alumniId = $(this).data('id');
            var url = alumniShowUrl.replace(':id', alumniId);
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    // Assuming you load profile details via AJAX as in the student page
                    // Modify this part based on your AJAX response handling
                    $('#profileModal' + alumniId + ' .modal-body').html(response);
                    $('#profileModal' + alumniId).modal('show');
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>

@endsection
