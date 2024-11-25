<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Smart Course</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>
    <link href="https://unpkg.com/flowbite@1.4.7/dist/flowbite.min.css" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
    <nav class="bg-transparent absolute top-0 w-full z-50">
        <div class="max-w-screen-xl mx-auto flex items-center justify-between p-4">
            <!-- Logo -->
            <a href="#" class="flex items-center">
                {{-- <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Education Logo" /> --}}
                <span class="ml-2 text-2xl font-semibold text-white">Education</span>
            </a>
            <!-- Navbar Links -->
            <div class="hidden md:flex items-center space-x-6">
                <a href="#" class="text-white hover:text-teal-400 transition">Home</a>
                <a href="#" class="text-white hover:text-teal-400 transition">All Courses</a>
                <a href="#" class="text-white hover:text-teal-400 transition">About Us</a>
                <a href="#" class="text-white hover:text-teal-400 transition">Contact</a>
                <button 
                    data-modal-target="start-learning-modal" 
                    data-modal-toggle="start-learning-modal"
                    class="hidden md:inline-block bg-teal-500 text-white px-4 py-2 rounded-full hover:bg-teal-600 transition">
                    Start Learning
                </button>
            </div>
            <!-- Mobile Menu Button -->
            {{-- <button class="md:hidden text-white focus:outline-none" id="menu-toggle">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button> --}}
        </div>
    </nav>
    <div id="start-learning-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full inset-0 h-modal h-full bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="relative bg-white rounded-lg shadow-lg w-full max-w-md">
            <!-- Close Button -->
            <button class="absolute top-2 right-2 text-gray-400 hover:text-gray-600" onclick="document.getElementById('start-learning-modal').classList.add('hidden');">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            <!-- Modal Header -->
            <div class="p-6 text-center">
                <h3 class="text-lg font-semibold text-gray-800">Start Learning</h3>
                <p class="mt-2 text-gray-600">Do you already have an account?</p>
            </div>
            <!-- Modal Body -->
            <div class="p-6 space-y-4 flex flex-col items-center">
                <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded w-full text-center">Login</a>
                <a href="{{ route('register') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded w-full text-center">Register</a>
            </div>
        </div>
    </div>
    
    <section class="relative bg-cover bg-center h-screen" style="background-image: url('{{ asset('images/course.jpg') }}');">
        <div class="absolute inset-0 bg-gray-600 opacity-50"></div>
        <div class="container mx-auto px-4 py-32 relative z-10 ml-4 text-white">
            <div class="text-xl uppercase mt-28">Welcome To Smart Course</div>
            <h1 class="text-5xl font-bold mt-4 break-words w-full max-w-3xl leading-relaxed">The world may change, but knowledge remains timeless</h1>
            <p class="mt-4 text-lg">A Place Where You Can Find The Learning Materials You Need.</p>
            <div class="mt-8">
                <a class="bg-blue-600 text-white px-6 py-3 rounded mr-4" href="#">Start Course</a>
                <a class="text-white underline" href="#">All Courses</a>
            </div>
        </div>
    </section>
    
    {{-- @auth
        <a href="{{ route('dashboard') }}">Go to Dashboard</a>
    @else
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Register</a>
    @endauth --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modalToggleButtons = document.querySelectorAll('[data-modal-toggle]');
            const modal = document.getElementById('start-learning-modal');

            modalToggleButtons.forEach(button => {
                button.addEventListener('click', function () {
                    modal.classList.toggle('hidden');
                });
            });

            // Close modal when clicking outside of it
            window.addEventListener('click', function (event) {
                if (event.target === modal) {
                    modal.classList.add('hidden');
                }
            });
        });
    </script>
    
</body>
</html>