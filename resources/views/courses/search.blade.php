
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>
    <link href="https://unpkg.com/flowbite@1.4.7/dist/flowbite.min.css" rel="stylesheet"/>
    <title>Document</title>
</head>
<body>
    @include('components.navbar')
    <div class="container mt-24 p-8">
        @if ($courses->isEmpty())
            <div class="max-w-sm p-6 bg-gradient-to-r from-green-200 to-blue-300 border border-black rounded-lg shadow ">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">No Results Found</h5>
                <p class="mb-3 font-normal text-gray-700 ">No courses found for your search. Please try again with a different query.</p>
                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-black rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                    Back to Dashboard
                </a>
            </div>
        @else
            <h1 class="text-2xl font-bold mb-6 text-center">Search Results</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($courses as $course)
                    <div class="max-w-sm p-6 bg-gradient-to-r from-green-200 to-blue-300  border border-black rounded-lg shadow ">
                        <a href="{{ route('courses.show', $course->id) }}">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $course->course_name }}
                            </h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700">
                            {{ \Illuminate\Support\Str::limit($course->description, 100, '...') }}
                        </p>
                        <a href="{{ route('courses.show', $course->id) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-black rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                            Read more
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    
</body>
</html>
