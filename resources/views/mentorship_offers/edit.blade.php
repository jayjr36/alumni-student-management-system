@extends('layout')

@section('content')
    <div class="container">
        <h5>{{ isset($mentorshipOffer) ? 'Edit Mentorship Offer' : 'Create Mentorship Offer' }}</h5>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ isset($mentorshipOffer) ? route('mentorship_offers.update', $mentorshipOffer) : route('mentorship_offers.store') }}">
            @csrf
            @if (isset($mentorshipOffer))
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', isset($mentorshipOffer) ? $mentorshipOffer->title : '') }}">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', isset($mentorshipOffer) ? $mentorshipOffer->description : '') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
