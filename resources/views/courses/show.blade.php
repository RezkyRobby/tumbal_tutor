@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-gray-100 rounded-lg shadow-lg">
    <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $course->course_name }}</h1>
    <p class="text-gray-600 mb-2">{{ $course->description }}</p>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
        <p><strong>Start Date:</strong> {{ $course->start_date }}</p>
        <p><strong>End Date:</strong> {{ $course->end_date }}</p>
        <p><strong>Enrolled Students:</strong> {{ $course->enrollments->count() }}</p>
    </div>

    <!-- Enrollment logic -->
    @if(auth()->user()->role === 'Student' && !$course->enrollments->where('user_id', auth()->id())->count())
        <form action="{{ route('enrollments.store') }}" method="POST" class="mb-6">
            @csrf
            <input type="hidden" name="course_id" value="{{ $course->id }}">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                Join Course
            </button>
        </form>
    @else
        <p class="text-green-600 font-semibold mb-6">You are already enrolled in this course.</p>
    @endif

    <!-- Enrolled Students -->
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Enrolled Students</h2>
    <ul class="list-disc pl-5 space-y-1 mb-6">
        @forelse ($course->enrollments as $enrollment)
            <li>{{ $enrollment->user->username ?? 'Unknown User' }}</li>
        @empty
            <p class="text-gray-500">No students enrolled yet.</p>
        @endforelse
    </ul>

    <!-- Course Contents -->
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Course Contents</h2>
    <ul class="space-y-4 mb-6">
        @forelse ($course->contents as $content)
            <li class="bg-white p-4 rounded-lg shadow">
                <h3 class="text-lg font-bold">{{ $content->title }}</h3>
                <p class="text-gray-600">{{ $content->body }}</p>
                <p class="text-sm text-gray-500">Type: {{ $content->media_type }}</p>
                <a href="{{ route('contents.view', $content->id) }}" class="text-blue-500 hover:underline">
                    View Content
                </a>
            </li>
        @empty
            <p class="text-gray-500">No contents available for this course.</p>
        @endforelse
    </ul>

    <!-- Forums -->
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Forums</h2>
    <ul class="space-y-4 mb-6">
        @forelse ($course->forums as $forum)
            <li class="bg-white p-4 rounded-lg shadow">
                <a href="{{ route('forums.show', $forum->id) }}" class="text-lg font-bold text-blue-500 hover:underline">
                    {{ $forum->topic }}
                </a>
                <p class="text-gray-600">{{ $forum->discussions->count() }} discussions</p>
            </li>
        @empty
            <p class="text-gray-500">No forums available yet.</p>
        @endforelse
    </ul>

    <!-- Create Forum button -->
    @if(auth()->user()->role === 'Teacher' || auth()->user()->role === 'Student')
        <a href="{{ route('forums.create', $course->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
            Create Forum
        </a>
    @endif

    <div class="mt-6">
        <a href="{{ route('dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
            Back to Dashboard
        </a>
    </div>
</div>
@endsection
