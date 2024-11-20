<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Certificates</title>
</head>
<body>
    <h1>Certificates</h1>
    <ul>
        @foreach ($certificates as $certificate)
            <li>
                {{ $certificate->course->name }} - Issued on {{ $certificate->issued_at }}
                <a href="{{ route('certificates.download', $certificate->id) }}">Download</a>
            </li>
        @endforeach
    </ul>
</body>
</html>
