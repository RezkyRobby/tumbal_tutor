@extends('layouts.app')

@section('content')
<div class="container mt-16">
    <h1>Search Results</h1>

    @if ($courses->isEmpty())
        <p>No courses found for your search.</p>
    @else
        <ul>
            @foreach ($courses as $course)
                <li>
                    <a href="{{ route('courses.show', $course->id) }}">{{ $course->course_name }}</a>
                    <p>{{ $course->description }}</p>
                </li>
            @endforeach
        </ul>
    @endif

    <a href="{{ route('courses.index') }}" class="btn btn-secondary">Back to All Courses</a>
</div>
@endsection
