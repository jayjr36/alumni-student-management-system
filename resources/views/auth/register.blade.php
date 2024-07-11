@extends('layout')

@section('content')
<div class="container-fluid text-white py-5" style="height: 100vh; background-color: #f8f9fa;">
    <div class="row justify-content-center align-items-center" style="height: 100%;">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header text-center bg-primary text-white">
                    <h3>{{ __('Join DIT Mentorship Platform') }}</h3>
                    <p>Empowering Students and Alumni through Connection</p>
                </div>

                <div class="card-body">
                    <div class="text-center mb-4">
                        <img src="{{ asset('images/mentorship.png') }}" alt="Mentorship" class="img-fluid" style="max-height: 200px;">
                    </div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="regNumber" class="col-md-4 col-form-label text-md-end">{{ __('Registration Number') }}</label>

                            <div class="col-md-6">
                                <input id="regNumber" type="number" class="form-control @error('regNumber') is-invalid @enderror" name="regNumber" value="{{ old('regNumber') }}" required>

                                @error('regNumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-6 d-flex justify-content-center px-5 mb-0">
                                <div class="col-md-12 px-5">
                                    <button type="submit" class="btn btn-success btn-sm w-100">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row text-center mt-3">
                            <a href="{{ route('login') }}" class="text-decoration-none">{{ __('Sign in to your account') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
