<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}" required>
        <br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        <br>

        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="student" {{ $user->role == 'student' ? 'selected' : '' }}>Student</option>
            <option value="teacher" {{ $user->role == 'teacher' ? 'selected' : '' }}>Teacher</option>
        </select>
        <br>

        <button type="submit">Update User</button>
    </form>
</body>
</html>
