@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your Certificates</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if ($certificates->isEmpty())
        <p>No certificates available.</p>
    @else
        <ul>
            @foreach ($certificates as $certificate)
                <li>
                    <strong>{{ $certificate->course->course_name }}</strong> - Issued on {{ $certificate->issued_at->format('d M Y') }}
                    <a href="{{ route('certificates.download', $certificate->id) }}" class="btn btn-sm btn-primary">Download Certificate</a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
