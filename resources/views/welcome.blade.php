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
        .scrollable-description {
            max-height: 100px;
            overflow-y: auto;
        }
    </style>
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-xl font-semibold text-gray-800 ml-2">Tutoring Course</h1>
         <div class="flex items-center">
          <nav class="ml-10 space-x-4">
          
           <a class="text-gray-700 hover:text-green-500" href="#">
            About
           </a>
           <a class="text-gray-700 hover:text-green-500" href="#">
            Courses
           </a>
           <a class="text-gray-700 hover:text-green-500" href="#">
            Contact
           </a>
           <a class="bg-green-500 hover:bg-blue-300 text-white px-4 py-2 rounded" href="{{ route('login') }}">
            Login
           </a>
           <a class="bg-blue-300 hover:bg-green-500 text-white px-4 py-2 rounded" href="{{ route('register') }}">
            register
           </a>
        </nav>
         </div>
         </div>
        </div>
       </header>
       <section class="bg-gradient-to-r from-green-200 to-blue-200 py-20">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center">
         <div class="md:w-1/2">
          <h1 class="text-4xl md:text-5xl font-bold text-gray-800">
           Better Learning Future Starts With Us!
          </h1>
          <p class="mt-4 text-gray-600">
           Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.
          </p>
         </div>
         <div class="md:w-1/2 mt-10 md:mt-0 ">
          <img alt="Student with books" class="w-full" height="500" src="{{ asset('images/stocklandingpagerobby-Photoroom.png') }}" width="500"/>
         </div>
        </div>
       </section>

    <div id="available" class="container mx-auto mt-10 p-8">
        <h2 class="text-3xl font-bold text-center mb-6">Available Courses</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($courses as $course)
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold">{{ $course->course_name }}</h3>
                    <p class="mt-2 scrollable-description">{{ $course->description }}</p>
                    <a href="{{ route('courses.show', $course->id) }}" class="text-blue-500 mt-4 inline-block">View Details</a>
                </div>
            @endforeach
        </div>
    </div>

     
<!-- Testimonials Section -->
<section class="bg-gray-100 py-20">
    <div class="container mx-auto px-4">
     <div class="text-center">
      <h2 class="text-3xl font-bold text-gray-800">
       What Our Students Says
      </h2>
      <p class="mt-4 text-gray-600">
       Lorem ipsum dolor sit amet, consectetur adipiscing elit.
      </p>
     </div>
     <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-8">
      <div class="bg-white shadow-lg p-6 rounded text-center">
       <p class="text-gray-600">
        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam."
       </p>
       <h3 class="mt-4 text-xl font-bold text-gray-800">
       Windah Batubara
       </h3>
       <img alt="Student Image" class="w-24 h-24 rounded-full mx-auto mt-4" height="100" src="{{ asset('images/windahtolcipularang.jpg') }}" width="100"/>
      </div>
      <div class="bg-white shadow-lg p-6 rounded text-center">
       <p class="text-gray-600">
        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam."
       </p>
       <h3 class="mt-4 text-xl font-bold text-gray-800">
        Windi Basuhkaki
       </h3>
       <img alt="Student Image" class="w-24 h-24 rounded-full mx-auto mt-4" height="100" src="{{ asset('images/windah basudara meme.jpg') }}" width="100"/>
      </div>
      <div class="bg-white shadow-lg p-6 rounded text-center">
       <p class="text-gray-600">
        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam."
       </p>
       <h3 class="mt-4 text-xl font-bold text-gray-800">
        Winde Basouzki
       </h3>
       <img alt="Student Image" class="w-24 h-24 rounded-full mx-auto mt-4" height="100" src="{{ asset('images/Meme windah.jpg') }}" width="100"/>
      </div>
     </div>
    </div>
   </section>

   <footer class="bg-gradient-to-r from-green-200 to-blue-300 text-gray-500 py-12">
    <div class="container mx-auto px-4">    
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 p-4">
            <div>
                <h3 class="text-2xl font-bold mb-4">Tutoring Course</h3>
                <p class="text-black mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce vitae risus nec dui venenatis dignissim.</p>
                <div class="flex space-x-4">
                    <a class="text-black" href="#"><i class="fab fa-twitter"></i></a>
                    <a class="text-black" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="text-black" href="#"><i class="fab fa-instagram"></i></a>
                    <a class="text-black" href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <!-- Tambahkan kelas text-right ke div Contact Info -->
            <div class="text-right sm:col-span-2 lg:col-start-4 lg:col-span-1">
                <h3 class="text-2xl font-bold mb-4">Contact Info</h3>
                <ul class="text-black space-y-2">
                    <li><i class="fas fa-phone-alt"></i> +88 457 845 695</li>
                    <li><i class="fas fa-envelope"></i> example@yourmail.com</li>
                    <li><i class="fas fa-map-marker-alt"></i> California, USA</li>
                </ul>
            </div>
        </div>
        <div class="text-center text-black mt-12">
            <p>© 2023. All Rights Reserved.</p>
            <div class="flex justify-center space-x-4 mt-4">
                <a class="text-black" href="#">Terms of use</a>
                <a class="text-black" href="#">Privacy Policy</a>
                <a class="text-black" href="#">Cookie Policy</a>
            </div>
        </div>
    </div>
</footer>

    
</body>
</html>