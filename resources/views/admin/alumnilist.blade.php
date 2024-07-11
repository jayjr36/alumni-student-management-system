@extends('layout')

@section('content')
    <div class="container-fluid" style="height: 100vh">
        <h1 class="text-center">Alumni List</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alumni as $alumnus)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $alumnus->name }}</td>
                        <td>
                            <button class="btn btn-primary view-profile" data-id="{{ $alumnus->id }}">View Profile</button>
                            <form action="{{ route('alumni.destroy', $alumnus->id) }}" method="POST" style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete {{ $alumnus->name }}?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Profile Modal -->
        <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="profileModalLabel">Alumni Profile</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="profileDetails">
                        <!-- Profile details will be loaded here via AJAX -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.view-profile').on('click', function() {
                var alumniId = $(this).data('id');
                $.ajax({
                    url: '{{ route('alumni.show') }}',
                    type: 'GET',
                    data: { id: alumniId },
                    success: function(response) {
                        $('#profileDetails').html(response);
                        $('#profileModal').modal('show');
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
