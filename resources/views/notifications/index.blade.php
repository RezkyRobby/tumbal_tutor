@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Notifications</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <ul>
        @forelse ($notifications as $notification)
            <li style="{{ $notification->read_at ? '' : 'font-weight: bold;' }}">
                <strong>{{ $notification->title }}</strong>
                <p>{{ $notification->message }}</p>
                @if ($notification->course)
                    <p>Related Course: <a href="{{ route('courses.show', $notification->course->id) }}">{{ $notification->course->course_name }}</a></p>
                @endif
                @if ($notification->content)
                    <p>Related Content: <a href="{{ route('contents.view', $notification->content->id) }}">{{ $notification->content->title }}</a></p>
                @endif

                <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-primary">Mark as Read</button>
                </form>
                <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </li>
        @empty
            <p>No notifications available.</p>
        @endforelse
    </ul>
</div>
@endsection
