@extends('layout')

@section('content')
    <div class="container-fluid " style="height: 100vh">
        <h1 class="text-center">Students List</h1>
        <table class="table table-striped col-md-6">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <!-- Add more columns as needed -->
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $student->name }}</td>
                        <!-- Add more columns as needed -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
