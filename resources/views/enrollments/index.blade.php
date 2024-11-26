<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Enrollments</title>
</head>
<body>
    <h1>Enrollments</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <ul>
        @foreach ($enrollments as $enrollment)
            <li>
                <strong>{{ $enrollment->course->course_name }}</strong> 
                by {{ $enrollment->course->user->username ?? 'Unknown' }} 
                - Progress: {{ $enrollment->progress }}%

                <a href="{{ route('courses.contents', $enrollment->course->id) }}" class="btn btn-primary">
                    View Contents
                </a>
            </li>
        @endforeach
    </ul>
</body>
</html>
