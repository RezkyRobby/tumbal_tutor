@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $forum->topic }}</h1>

    <h2>Discussions</h2>
    <ul>
        @foreach ($forum->discussions as $discussion)
            <li>
                <strong>{{ $discussion->user->username }}</strong>: {{ $discussion->message }}
                <form action="{{ route('discussions.destroy', $discussion->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>

    <h3>Add a Discussion</h3>
    <form action="{{ route('discussions.store', $forum->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <textarea name="message" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Post Discussion</button>
    </form>

    <a href="{{ route('courses.show', $forum->course_id) }}" class="btn btn-secondary">Back to Course</a>
</div>
@endsection
