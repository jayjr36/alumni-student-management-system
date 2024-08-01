@extends('layout')

@section('content')
<div class="container-fluid">
    <div class="card col-10">
        <div class="card-body">
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

        <div>
            @if ($approvedMentors->count() > 0)
                <div class="mt-4 mb-2">
                    <h4 class="text-center">Approved Mentors</h4>
                    <ul class="list-group text-center">
                        @foreach ($approvedMentors as $mentor)
                            <li class="list-group-item">
                                {{ $mentor->name }}
                                <!-- Button to request mentorship -->
                                <form
                                    action="{{ route('request.mentorship', ['mentor_id' => $mentor->id, 'student_id' => $student->id]) }}"
                                    method="POST" class="d-inline float-right">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm px-5 ml-4">Request
                                        Mentorship</button>
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
                <h6 class="text-center">MY MENTORS</h6>
                @if ($mentorsAcceptedByStudent->isEmpty())
                    <p>You have no mentors.</p>
                @else
                    <ul class="list-group">
                        @foreach ($mentorsAcceptedByStudent as $mentor)
                            <li class="list-group-item">
                                <strong>{{ $mentor->name }}</strong>
                                <ul>
                                    @forelse ($mentorClasses[$mentor->id] ?? [] as $class)
                                        <li>
                                            <h6>{{ $class->title }}</h6>
                                            <p>{{ $class->description }}</p>
                                            <form action="{{ route('classes.subscribe', $class->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="class_id" value="{{ $class->id }}">
                                                <button type="submit" class="btn btn-info btn-sm">SUBSCRIBE</button>
                                            </form>
                                        </li>
                                    @empty
                                        <p>No classes available.</p>
                                    @endforelse
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
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



{{-- @extends('layout')

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
            <a href="{{ route('student.classes') }}" class="btn btn-outlined-secondary">Available Classes</a>
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
                                    <button type="submit" class="btn btn-success btn-sm px-5 ml-4">Request
                                        Mentorship</button>
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

                            <a href="{{ route('mentor.classes', $mentor->id) }}" class="btn btn-primary btn-sm float-right">View Classes</a>
              
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
