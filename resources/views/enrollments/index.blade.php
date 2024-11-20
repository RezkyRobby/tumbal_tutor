<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Enrollments</title>
</head>
<body>
    <h1>Enrollments</h1>
    <ul>
        @foreach ($enrollments as $enrollment)
            <li>
                {{ $enrollment->course->name }} - Progress: {{ $enrollment->progress }}%
                <form action="{{ route('enrollments.updateProgress', $enrollment->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('PATCH')
                    <input type="number" name="progress" value="{{ $enrollment->progress }}" min="0" max="100">
                    <button type="submit">Update Progress</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>
