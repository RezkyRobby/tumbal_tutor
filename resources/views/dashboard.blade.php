@extends('layouts.app')


@section('content')
<div class="container">
    <div class="flex flex-col items-center justify-center ">
        <h2 class="text-xl mb-6 mt-24">Top 5 Most Popular Courses</h2>
        <div class="flex flex-wrap gap-4 justify-center">
            @foreach ($popularCourses as $course)
                <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow d">
                    <div class="p-5">
                        <h5 class="mb-2 text-xl font-bold tracking-tight text-black ">{{ $course->course_name }}</h5>
                        <p class="mb-3 font-normal text-gray-700 d">{{ $course->description }}</p>
                        <p class="mb-3"><strong>Enrolled Students:</strong> {{ $course->enrollments_count }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="flex flex-col items-center justify-center ">
        <h2 class="text-2xl mt-24 mb-6">All Courses</h2>
        <div class="flex flex-wrap gap-4">
        @foreach ($allCourses as $course)
            <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow ">
                <div class="p-5">
                    <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 ">{{ $course->course_name }}</h5>
                    <p class="mb-3 font-normal text-gray-700 ">{{ $course->description }}</p>
                    <a href="{{ route('courses.show', $course->id) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-black rounded-lg hover:bg-violet-600 focus:ring-4 focus:outline-none focus:ring-blue-300">
                        View Details
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </a>
                </div>
            </div>
        @endforeach
        </div>
    </div>
   
</div>
@endsection
