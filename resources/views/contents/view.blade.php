@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <!-- Video Section -->
    <div class="relative w-full bg-gray-900 py-10 rounded-lg shadow-lg">
        <!-- Video Wrapper -->
        <div class="relative mx-auto max-w-5xl rounded-lg overflow-hidden bg-black p-6">
            <!-- Media Display -->
            <div class="relative w-full h-80 md:h-[450px] bg-black rounded-md overflow-hidden">
                @if ($content->media_type === 'youtube')
                    <!-- YouTube Embed -->
                    <iframe 
                        src="{{ $content->media_path }}" 
                        frameborder="0" 
                        allowfullscreen 
                        class="w-full h-full">
                    </iframe>
                @elseif ($content->media_type === 'video')
                    <!-- Video Player -->
                    <video 
                        controls 
                        class="w-full h-full">
                        <source src="{{ asset('storage/' . $content->media_path) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @elseif ($content->media_type === 'file')
                    <!-- File Viewer -->
                    @php
                        $fileExtension = pathinfo($content->media_path, PATHINFO_EXTENSION);
                    @endphp
    
                    @if (in_array($fileExtension, ['pdf']))
                        <!-- PDF Viewer -->
                        <iframe 
                            src="{{ asset('storage/' . $content->media_path) }}" 
                            frameborder="0" 
                            class="w-full h-full">
                        </iframe>
                    @else
                        <!-- Download Link for Other Files -->
                        <div class="flex flex-col items-center justify-center h-full text-gray-200">
                            <p class="mb-4 text-lg">File available for download: {{ strtoupper($fileExtension) }}</p>
                            <a 
                                href="{{ asset('storage/' . $content->media_path) }}" 
                                download 
                                class="px-6 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                                Download File
                            </a>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>

    <!-- Title and Description Section -->
    <div class="relative w-full bg-gradient-to-r from-green-200 to-blue-300 py-12 px-6 md:px-16 mt-12 rounded-lg shadow-lg">
        <div class="max-w-4xl mx-auto text-center text-black">
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight mb-6">
                {{ $content->title }}
            </h1>
            <p class="text-lg md:text-xl font-light opacity-90 leading-relaxed">
                {{ $content->body }}
            </p>
        </div>
        <!-- Decorative Elements -->
        <div class="absolute top-0 left-0 w-40 h-40 bg-purple-500 opacity-30 blur-lg rounded-full -translate-x-10 -translate-y-10"></div>
        <div class="absolute bottom-0 right-0 w-52 h-52 bg-blue-400 opacity-30 blur-lg rounded-full translate-x-12 translate-y-12"></div>
    </div>

    <!-- Action Buttons -->
    <div class="flex flex-col md:flex-row items-center justify-center gap-4 mt-10">
        <form action="{{ route('progress.markAsDone', $content->id) }}" method="POST">
            @csrf
            <button type="submit" class="px-6 py-2 mb-10 text-white bg-green-600 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-4 focus:ring-green-300">
                Mark as Done
            </button>
        </form>
        <a href="{{ route('courses.contents', $content->course_id) }}" 
           class="px-6 py-2 mb-10 text-white bg-gray-600 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-300">
            Back to Contents
        </a>
    </div>
</div>
@endsection
