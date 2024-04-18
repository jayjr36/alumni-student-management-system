@extends('layout')

@section('content')
    <div class="sidebar"
        style=" height: 100vh; position: fixed; top: 0; left: 0; width: 250px; padding: 20px; background-color: #f8f9fa;">
        <h3>Admin Dashboard</h3>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('students.index') }}" target="iframe_content">Students</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('alumni.index') }}" target="iframe_content">Alumni</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('students.create') }}" target="iframe_content">Add Students</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('alumni.create') }}" target="iframe_content">Add Alumni</a>
            </li>
            <!-- Add more sidebar links as needed -->
        </ul>
    </div>

    <div class="iframe-container" style="margin-left: 250px; padding: 20px;">
        <iframe name="iframe_content" style="width: 100%; height: 100vh; border: none;"></iframe>
    </div>
@endsection
