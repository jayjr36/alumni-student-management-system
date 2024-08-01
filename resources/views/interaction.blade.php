@extends('layout')

@section('content')
<div class="container col-5 mt-4">
    <h3 class="text-center">User Search</h3>
    <form action="{{ route('search') }}" method="GET" class="form-inline justify-content-center mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search for users">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>

    @if(isset($users))
        <h3 class="col-5 text-center">Search Results</h3>
        <ul class="list-group">
            @foreach($users as $user)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $user->name }}
                    @if($user->id !== auth()->id())
                        <div>
                            <a href="{{ route('chat', ['receiver_id' => $user->id]) }}" class="btn btn-primary btn-sm">Chat</a>
                            <button data-toggle="modal"
                            data-target="#profileModal" class="btn btn-info btn-sm ml-2 view-profile-btn" data-guest-id="{{ $user->guestid }}">View Profile</button>
                        </div>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
</div>

<!-- Modal for User Profile -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileModalLabel">User Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="profile-content">
                    <!-- Profile content loaded dynamically -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>

</div>

@endsection
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS and CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    
@push('scripts')
<script>
$(document).ready(function() {
    $('.view-profile-btn').on('click', function() {
        var guestId = $(this).data('guest-id');

        $.ajax({
            url: '/user-profile/' + guestId,
            type: 'GET',
            success: function(response) {
                $('#profile-content').html(`
                    <h5>${response.name}</h5>
                    <p><strong>Bio:</strong> ${response.bio}</p>
                    <p><strong>Profile Picture:</strong> <img src="${response.profile_picture}" alt="Profile Picture" class="img-fluid"></p>
                    <!-- Add other user fields here -->
                `);
                $('#profileModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching user profile:', error);
            }
        });
    });
});
</script>
@endpush
