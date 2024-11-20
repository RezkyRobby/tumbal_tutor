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
</div>
@endsection
