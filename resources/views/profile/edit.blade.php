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

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ old('username', auth()->user()->username) }}">
        <br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}">
        <br>

        <button type="submit">Update</button>
    </form>

    <form action="{{ route('profile.destroy') }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete Account</button>
    </form>
</body>
</html>
