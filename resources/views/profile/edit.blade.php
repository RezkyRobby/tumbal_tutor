<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>
<body>
    <h1>Edit Profile</h1>
    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PATCH')

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}" required>
        <br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        <br>

        <button type="submit">Update Profile</button>
    </form>

    <form action="{{ route('profile.destroy') }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete Account</button>
    </form>
</body>
</html>
