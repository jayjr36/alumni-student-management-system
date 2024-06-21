@extends('layout')

@section('content')
    <div class="container-fluid " style="height: 100vh">
        <h1 class="text-center">Alumni List</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <!-- Add more columns as needed -->
                </tr>
            </thead>
            <tbody>
                @foreach ($alumni as $alumnus)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $alumnus->name }}</td>
                        <!-- Add more columns as needed -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
