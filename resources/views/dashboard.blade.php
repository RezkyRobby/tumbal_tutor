@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard</h1>
    <p>Welcome, {{ auth()->user()->username ?? 'User' }}!</p>

    <ul>
        <li><a href="{{ route('profile.edit') }}">Edit Profile</a></li>
        <li><a href="{{ route('certificates.index') }}">My Certificates</a></li>
        <li><a href="{{ route('notifications.index') }}">My Notifications</a></li>
    </ul>

    @if(auth()->user()->role === 'Admin' || auth()->user()->role === 'Teacher')
        <h2>Admin/Teacher Panel</h2>
        <ul>
            <li><a href="{{ route('courses.index') }}">Manage Courses</a></li>
            <li><a href="{{ route('contents.index') }}">Manage Contents</a></li>
        </ul>
    @elseif(auth()->user()->role === 'Student')
        <h2>Student Panel</h2>
        <ul>
            <li><a href="{{ route('enrollments.index') }}">My Enrollments</a></li>
        </ul>
    @endif

    <h2>Top 5 Most Popular Courses</h2>
    <div class="row">
        @foreach ($popularCourses as $course)
            <div class="col-md-4">
                <div class="card" style="margin-bottom: 20px;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $course->course_name }}</h5>
                        <p class="card-text">{{ $course->description }}</p>
                        <p><strong>Enrolled Students:</strong> {{ $course->enrollments_count }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <h2>All Courses</h2>
    <div class="row">
        @foreach ($allCourses as $course)
            <div class="col-md-4">
                <div class="card" style="margin-bottom: 20px;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $course->course_name }}</h5>
                        <p class="card-text">{{ $course->description }}</p>
                        <a href="{{ route('courses.show', $course->id) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
