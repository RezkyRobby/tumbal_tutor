<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Courses</title>
</head>
<body>
    <h1>Courses</h1>
    <a href="{{ route('courses.create') }}">Create New Course</a>
    <ul>
        @foreach ($courses as $course)
            <li>
                <a href="{{ route('courses.show', $course->id) }}">
                    {{ $course->course_name }}
                </a>
                - {{ $course->description }}
                <a href="{{ route('courses.edit', $course->id) }}">Edit</a>
                <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>

                <!-- Menampilkan progres siswa -->
                <h4>Student Progress:</h4>
                <ul>
                    @foreach ($course->enrollments as $enrollment)
                        <li>
                            {{ $enrollment->user->username }}: {{ $enrollment->progress }}%
                        </li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
    <button type="button">
        <a href="{{ route('dashboard') }}">Back to Dashboard</a>
    </button>
</body>
</html>
