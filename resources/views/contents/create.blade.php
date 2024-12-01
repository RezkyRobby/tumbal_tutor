@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-6">Create New Content</h1>
    
    <form action="{{ route('contents.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Pilih Kursus -->
        <div class="mb-4">
            <label for="course_id" class="block text-gray-700 font-medium">Select a Course</label>
            <select id="course_id" name="course_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
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
        </div>

        <!-- Title -->
        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-medium">Title</label>
            <input type="text" id="title" name="title"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                   value="{{ old('title') }}" required>
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Body -->
        <div class="mb-4">
            <label for="body" class="block text-gray-700 font-medium">Body</label>
            <textarea id="body" name="body" rows="5"
                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('body') }}</textarea>
            @error('body')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Media Type -->
        <div class="mb-4">
            <label for="media_type" class="block text-gray-700 font-medium">Media Type</label>
            <select id="media_type" name="media_type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                <option value="">Select Media Type</option>
                <option value="video" {{ old('media_type') == 'video' ? 'selected' : '' }}>Video</option>
                <option value="file" {{ old('media_type') == 'file' ? 'selected' : '' }}>File</option>
                <option value="youtube" {{ old('media_type') == 'youtube' ? 'selected' : '' }}>YouTube</option>
            </select>
            @error('media_type')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Media Path/File -->
        <div class="mb-4" id="media-file-input" style="display: none;">
            <label for="media_file" class="block text-gray-700 font-medium">Upload Media</label>
            <input type="file" id="media_file" name="media_file" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{old('media_path')}}">
            @error('media_file')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>        

        <div class="mb-4" id="media-url-input" style="display: none;">
            <label for="media_path" class="block text-gray-700 font-medium">YouTube URL</label>
            <input type="url" id="media_path" name="media_path"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                   value="{{ old('media_path') }}">
            @error('media_path')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="mb-6">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-medium rounded-md shadow-sm hover:bg-blue-600">
                Create Content
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const mediaTypeSelect = document.getElementById('media_type');
        const mediaFileInput = document.getElementById('media-file-input');
        const mediaUrlInput = document.getElementById('media-url-input');

        function toggleMediaInputs() {
            const selectedType = mediaTypeSelect.value;

            if (selectedType === 'video' || selectedType === 'file') {
                mediaFileInput.style.display = 'block';
                mediaUrlInput.style.display = 'none';
            } else if (selectedType === 'youtube') {
                mediaFileInput.style.display = 'none';
                mediaUrlInput.style.display = 'block';
            } else {
                mediaFileInput.style.display = 'none';
                mediaUrlInput.style.display = 'none';
            }
        }

        mediaTypeSelect.addEventListener('change', toggleMediaInputs);
        toggleMediaInputs(); // Initialize on page load
    });
</script>
@endsection
