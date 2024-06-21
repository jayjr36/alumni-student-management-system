<!-- alumni.create.blade.php -->
@extends('layout')

@section('content')
    <div class="container-fluid " style="height: 100vh">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card bg-dark text-white py-5">
                    <div class="card-header">Add Alumni</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form method="POST" action="{{ route('alumni.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" type="text" class="form-control" name="name" required autofocus>
                            </div>
                            <div class="row px-3 py-3">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
