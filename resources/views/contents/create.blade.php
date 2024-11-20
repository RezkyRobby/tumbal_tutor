@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-6">Create New Content</h1>

    <form action="{{ route('contents.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Pilih Kursus -->
        <select id="course_id" name="course_id"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
    <option value="">Select a Course</option>
    @foreach ($courses as $course)
        <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
            {{ $course->course_name }}
        </option>
    @endforeach
</select>
@error('course_id')
    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
@enderror


        <!-- Field lainnya -->
        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-medium">Title</label>
            <input type="text" id="title" name="title"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                   value="{{ old('title') }}" required>
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tambahkan body, media_type, media_path, dll. -->

        <div class="mb-6">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-medium rounded-md shadow-sm hover:bg-blue-600">
                Create Content
            </button>
        </div>
    </form>
</div>
@endsection
