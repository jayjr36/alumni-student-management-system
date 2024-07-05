@extends('layout')

@section('content')
<div class="sidebar bg-light" style="height: 100vh; position: fixed; top: 0; left: 0; width: 250px; padding: 20px;">
    <h3 class="text-center pb-3 border-bottom">Dashboard</h3>
    <ul class="nav flex-column mt-4">
        <li class="nav-item">
            <a class="nav-link text-dark active" href="{{ route('posts.index') }}" target="iframe_content">
                <i class="bi bi-house-door"></i> Newsfeed
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('students.index') }}" target="iframe_content">
                <i class="bi bi-people"></i> Students
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('alumni.index') }}" target="iframe_content">
                <i class="bi bi-person-badge"></i> Alumni
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('students.create') }}" target="iframe_content">
                <i class="bi bi-person-plus"></i> Add Students
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('alumni.create') }}" target="iframe_content">
                <i class="bi bi-person-plus-fill"></i> Add Alumni
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('post.create') }}" target="iframe_content">
                <i class="bi bi-file-earmark-post"></i> Post to Newsfeed
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('admin.mentor.requests') }}" target="iframe_content">
                <i class="bi bi-person-plus"></i> Mentorship Requests
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</div>


    <div class="iframe-container" style="margin-left: 250px; padding: 20px;">
        <iframe src="{{route('adminhome')}}" name="iframe_content" style="width: 100%; height: 100vh; border: none;"></iframe>
    </div>
@endsection
