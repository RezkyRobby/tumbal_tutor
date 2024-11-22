<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join a Course</title>
</head>
<body>
    <h1>Join a Course</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <form action="{{ route('enrollments.store') }}" method="POST">
        @csrf
        <label for="course_id">Select a Course:</label>
        <select name="course_id" id="course_id" required>
            <option value="" disabled selected>Choose a course</option>
            @foreach ($courses as $course)
                <option value="{{ $course->id }}">
                    {{ $course->course_name }} 
                    (by {{ $course->user->username ?? 'Unknown' }})
                </option>
            @endforeach
        </select>
        <button type="submit">Join Course</button>
    </form>

    <a href="{{ route('enrollments.index') }}">Back to My Enrollments</a>
</body>
</html>
