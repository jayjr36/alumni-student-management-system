@extends('layout')

@section('content')
    <div class="container col-6">
        <!-- Session Messages -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Approved Mentors Section -->
        <div>
            @if ($approvedMentors->count() > 0)
                <div class="mt-4">
                    <h4 class="text-center">Approved Mentors</h4>
                    <ul class="list-group">
                        @foreach ($approvedMentors as $mentor)
                            <li class="list-group-item">
                                {{ $mentor->name }}
                                <!-- Button to request mentorship -->
                                <form
                                    action="{{ route('request.mentorship', ['mentor_id' => $mentor->id, 'student_id' => $student->id]) }}"
                                    method="POST" class="d-inline float-right">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm px-5 ml-4">Request Mentorship</button>
                                </form>
                                <button type="button" class="btn btn-info btn-sm float-right ml-2 px-5" data-toggle="modal"
                                data-target="#mentorModal{{ $mentor->id }}">
                                View Profile
                            </button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @else
                <div class="mt-4">
                    <p class="text-center">No mentors available at the moment.</p>
                </div>
            @endif
        </div>

        <!-- Mentors Accepted by Student Section -->
        <div class="mt-4">
            <h4 class="text-center">Your Accepted Mentors</h4>
            @if ($mentorsAcceptedByStudent->count() > 0)
                <ul class="list-group">
                    @foreach ($mentorsAcceptedByStudent as $mentor)
                        <li class="list-group-item">
                            {{ $mentor->name }}
                            <!-- Button to view mentor profile -->
                           
                             <!-- Mentor Profile Modal -->
                    {{-- <div class="modal fade" id="mentorModal{{ $mentor->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="mentorModalLabel{{ $mentor->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="mentorModalLabel{{ $mentor->id }}">{{ $mentor->name }}'s
                                        Profile</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Graduation Year:</strong> {{ $mentor->graduation_year }}</p>
                                    <p><strong>Degree:</strong> {{ $mentor->degree }}</p>
                                    <p><strong>Bio:</strong> {{ $mentor->bio }}</p>
                                    @if ($mentor->profile_picture)
                                        <img src="{{ asset('images/profile_pictures/' . $mentor->profile_picture) }}"
                                            alt="{{ $mentor->name }}" class="img-fluid">
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                {{-- @endforeach
            </ul>
        </div>
                        </li> --}}
                    @endforeach
                </ul>
            @else
                <p class="text-center">You have no accepted mentors.</p>
            @endif
        </div>


                    <!-- Mentor Profile Modal -->
                    <div class="modal fade" id="mentorModal{{ $mentor->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="mentorModalLabel{{ $mentor->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="mentorModalLabel{{ $mentor->id }}">{{ $mentor->name }}'s
                                        Profile</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Graduation Year:</strong> {{ $mentor->graduation_year }}</p>
                                    <p><strong>Degree:</strong> {{ $mentor->degree }}</p>
                                    <p><strong>Bio:</strong> {{ $mentor->bio }}</p>
                                    @if ($mentor->profile_picture)
                                        <img src="{{ asset('images/profile_pictures/' . $mentor->profile_picture) }}"
                                            alt="{{ $mentor->name }}" class="img-fluid">
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- @endforeach
            </ul>
        </div> --}}

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </div>
@endsection





{{-- @extends('layout')

@section('content')

    @if ($mentorshipOffers->isEmpty())
        <div class="alert alert-info" role="alert">
            No mentorship offers available.
        </div>
    @else
        <div class="row">
            @foreach ($mentorshipOffers as $mentorshipOffer)
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $mentorshipOffer->title }}</h5>
                            <p class="card-text">{{ $mentorshipOffer->description }}</p>
                            <p class="card-text"><small class="text-muted">Offered by: {{ $mentorshipOffer->alumni->name }}</small></p>
                            
                            @if (auth()->check() && auth()->user()->role == 'student')
                                @php
                                    $mentorshipRequest = auth()->user()->mentorshipRequests()->where('mentorship_offer_id', $mentorshipOffer->id)->first();
                                @endphp

                                @if ($mentorshipRequest)
                                    @if ($mentorshipRequest->accepted)
                                        <p class="text-success">Status: Accepted</p>
                                    @else
                                        <p class="text-danger">Status: Rejected</p>
                                    @endif
                                @else
                                    <form action="{{ route('mentorship_requests.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="mentorship_offer_id" value="{{ $mentorshipOffer->id }}">
                                        <button type="submit" class="btn btn-success btn-sm">Request Mentorship</button>
                                    </form>
                                @endif
                            @elseif (auth()->check() && auth()->user()->role == 'alumni' && auth()->user()->id == $mentorshipOffer->alumni_id)
                                <a href="{{ route('mentorship_offers.edit', $mentorshipOffer) }}" class="btn btn-primary btn-sm">Edit Offer</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection --}}
