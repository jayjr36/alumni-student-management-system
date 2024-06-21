@extends('layout')

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
@endsection
