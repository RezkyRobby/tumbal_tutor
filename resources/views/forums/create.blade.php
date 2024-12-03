@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Forum</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('forums.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="topic">Forum Topic</label>
            <input type="text" name="topic" id="topic" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="course_id">Select Course</label>
            <select name="course_id" id="course_id" class="form-control" required onchange="updateBackButton()">
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create Forum</button>
    </form>

    <!-- Tombol kembali ke halaman detail kursus -->
    <a id="backButton" href="{{ route('courses.show', $courses->first()->id) }}" class="btn btn-secondary">Back to Course</a>
</div>

<script>
    function updateBackButton() {
        const courseId = document.getElementById('course_id').value;
        const backButton = document.getElementById('backButton');
        backButton.href = `/courses/${courseId}`; // Sesuaikan dengan route yang benar
    }
</script>
@endsection
