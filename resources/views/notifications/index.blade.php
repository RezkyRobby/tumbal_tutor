<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
</head>
<body>
    <h1>Notifications</h1>
    <ul>
        @foreach ($notifications as $notification)
            <li>
                {{ $notification->title }} - {{ $notification->message }}
                @if ($notification->read_at)
                    <span>(Read)</span>
                @else
                    <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit">Mark as Read</button>
                    </form>
                @endif
                <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>
