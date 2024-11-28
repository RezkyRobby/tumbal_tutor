@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $course->course_name }}</h1>
    <p>{{ $course->description }}</p>
    <p><strong>Start Date:</strong> {{ $course->start_date }}</p>
    <p><strong>End Date:</strong> {{ $course->end_date }}</p>
    <p><strong>Enrolled Students:</strong> {{ $course->enrollments->count() }}</p>

    <!-- Jika user adalah Student dan belum terdaftar -->
    @if(auth()->user()->role === 'Student' && !$course->enrollments->where('user_id', auth()->id())->count())
        <form action="{{ route('enrollments.store') }}" method="POST">
            @csrf
            <input type="hidden" name="course_id" value="{{ $course->id }}">
            <button type="submit" class="btn btn-primary">Join Course</button>
        </form>
    @else
        <p class="text-success">You are already enrolled in this course.</p>
    @endif

    <h2>Enrolled Students</h2>
    <ul>
        @forelse ($course->enrollments as $enrollment)
            <li>{{ $enrollment->user->username ?? 'Unknown User' }}</li>
        @empty
            <p>No students enrolled yet.</p>
        @endforelse
    </ul>

    <h2>Course Contents</h2>
    <ul>
        @forelse ($course->contents as $content)
            <li>
                <strong>{{ $content->title }}</strong> ({{ $content->media_type }}) description: {{ $content->body}}
                <a href="{{ route('contents.view', $content->id) }}" class="btn btn-sm btn-primary">View Content</a>
                @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
            </li>
        @empty
            <p>No contents available for this course.</p>
        @endforelse
    </ul>

    <a href="{{ route('dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
</div>
@endsection
