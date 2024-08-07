@extends('layout')

@section('content')
<div class="container-fluid" style="height: 100vh; background-color: #f8f9fa;">
    <div class="row justify-content-center align-items-center" style="height: 100%;">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header text-center bg-primary text-white">
                    <h3>{{ __('Welcome to DIT Mentorship Platform') }}</h3>
                    <p>Connecting Students and Alumni for a Brighter Future</p>
                </div>

                <div class="card-body">
                    <div class="text-center mb-4">
                        <img src="{{ asset('images/mentorship.png') }}" alt="Mentorship" class="img-fluid" style="max-height: 200px;">
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-6 d-flex justify-content-center px-5 mb-0">
                                <div class="col-md-12 px-5">
                                    <button type="submit" class="btn btn-success btn-sm w-100">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row text-center mt-3">
                            <a href="{{route('register')}}" class="text-decoration-none">{{ __('Create an account') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
