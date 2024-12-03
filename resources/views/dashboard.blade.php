@extends('layouts.app')


@section('content')
<style>
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .no-scrollbar {
        -ms-overflow-style: none;  /* Internet Explorer 10+ */
        scrollbar-width: none;  /* Firefox */
    }
</style>
<div class="container">
    <div class="flex flex-col items-center justify-center p-6">
        <h2 class="text-3xl font-bold mb-6 mt-24">Top 5 Most Popular Courses</h2>
    
        <!-- Slider Container -->
        <div class="relative w-full">
            <!-- Tombol Navigasi Kiri -->
            <button id="prev" class="absolute left-0 top-1/2 transform -translate-y-1/2 -ml-6 bg-green-200 hover:bg-blue-300 text-gray-800 font-bold py-2 px-4 rounded-full z-10">
                <img src="{{ asset('images/arr.png') }}" class="w-6 h-6">
            </button>
    
            <!-- Slider -->
            <div id="slider" class="flex gap-6 overflow-x-auto scroll-smooth snap-x snap-mandatory p-4 w-full" style="scrollbar-width: none; -ms-overflow-style: none;">
                @foreach ($popularCourses as $course)
                    <div class="snap-start flex-shrink-0 w-full sm:w-2/3 lg:w-1/3 bg-white border border-gray-300 rounded-lg shadow-md flex flex-col">
                        <!-- Header Section -->
                        <div class="h-24 rounded-t-lg bg-gradient-to-br from-green-200 to-blue-300 flex items-center justify-center">
                            <span class="text-white font-bold text-lg text-center">{{ $course->course_name }}</span>
                        </div>
                        
                        <!-- Content Section -->
                        <div class="p-4 flex-grow overflow-hidden">
                            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900">{{ $course->course_name }}</h5>
                            <div class="text-gray-700 mb-2 h-32 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100 no-scrollbar">
                                {{ $course->description }}
                            </div>
                            <p class="text-blue-700 font-bold mb-2">
                                Enrolled Students: {{ $course->enrollments_count }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
    
            <!-- Tombol Navigasi Kanan -->
            <button id="next" class="absolute right-0 top-1/2 transform -translate-y-1/2 -mr-6 bg-blue-200 hover:bg-green-200 text-gray-800 font-bold py-2 px-4 rounded-full z-10">
                <img src="{{ asset('images/arrkanan.png') }}" class="w-6 h-6">
            </button>
        </div>
    </div>
    
  
    
    
    
    <div class="flex flex-col items-center justify-center p-10">
        <h2 class="text-2xl mt-24 mb-6">All Courses</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($allCourses as $course)
                <div class="w-80 h-96 mx-auto bg-white border border-gray-200 rounded-lg shadow overflow-hidden">
                    <div class="p-5 flex flex-col justify-between h-full">
                        <div>
                            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900">{{ $course->course_name }}</h5>
                            <div class="overflow-y-auto h-60">
                                <p class="font-normal text-gray-700">{{ $course->description }}</p>
                            </div>
                        </div>
                        <a href="{{ route('courses.show', $course->id) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-300 rounded-lg hover:bg-green-400 focus:ring-4 focus:outline-none focus:ring-blue-300">
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
    
    


    <script>
        const slider = document.getElementById('slider');
        const next = document.getElementById('next');
        const prev = document.getElementById('prev');
    
        let scrollAmount = 0;
    
        // Fungsi untuk looping slider ke awal
        next.addEventListener('click', () => {
            const maxScrollLeft = slider.scrollWidth - slider.clientWidth;
            
            if (scrollAmount >= maxScrollLeft) {
                slider.scrollTo({ left: 0, behavior: 'smooth' });
                scrollAmount = 0;
            } else {
                slider.scrollBy({ left: 300, behavior: 'smooth' });
                scrollAmount += 300;
            }
        });
    
        // Fungsi untuk looping slider ke akhir
        prev.addEventListener('click', () => {
            if (scrollAmount <= 0) {
                scrollAmount = slider.scrollWidth - slider.clientWidth;
                slider.scrollTo({ left: scrollAmount, behavior: 'smooth' });
            } else {
                slider.scrollBy({ left: -300, behavior: 'smooth' });
                scrollAmount -= 300;
            }
        });
    
        // Deteksi jika user melakukan scroll manual
        slider.addEventListener('scroll', () => {
            scrollAmount = slider.scrollLeft;
        });
    </script>
</div>
@endsection
