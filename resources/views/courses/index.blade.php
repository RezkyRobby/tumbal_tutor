<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Courses</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100">
    @include('components.navbar')
    <div class="container mx-auto mt-24">
        <h1 class="text-2xl font-bold mb-6 text-center">Manage Courses</h1>

        <table class="table-auto w-full border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2">Course Name</th>
                    <th class="border border-gray-300 px-4 py-2">Description</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                    <tr class="hover:bg-gray-50">
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <button 
                                onclick="openModal({{ $course->id }})" 
                                class="text-blue-500 underline text-sm">
                                {{ $course->course_name }}
                            </button>
                        </td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <button 
                                onclick="openDescriptionModal({{ $course->id }})" 
                                class="text-blue-500 underline text-sm">
                                View Description
                            </button>
                        </td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <a href="{{ route('courses.edit', $course->id) }}" class="text-yellow-500 mx-2">Edit</a>
                            <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Delete</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal for Student Progress -->
                    <tr id="modal-{{ $course->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
                        <td colspan="4">
                            <div class="bg-white p-6 rounded shadow-lg w-1/2 mx-auto">
                                <h3 class="text-xl font-bold mb-4">Student Progress for {{ $course->course_name }}</h3>
                                <ul class="list-disc pl-5">
                                    @foreach ($course->enrollments as $enrollment)
                                        <li>
                                            {{ $enrollment->user->username }}: {{ $enrollment->progress }}%
                                        </li>
                                    @endforeach
                                </ul>
                                <button 
                                    onclick="closeModal({{ $course->id }})" 
                                    class="mt-4 bg-red-500 text-white px-4 py-2 rounded">
                                    Close
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal for Course Description -->
                    <tr id="description-modal-{{ $course->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
                        <td colspan="4">
                            <div class="bg-white p-6 rounded shadow-lg w-1/2 mx-auto">
                                <h3 class="text-xl font-bold mb-4">Course Description</h3>
                                <p>{{ $course->description }}</p>
                                <button 
                                    onclick="closeDescriptionModal({{ $course->id }})" 
                                    class="mt-4 bg-red-500 text-white px-4 py-2 rounded">
                                    Close
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="fixed bottom-28 left-60 ">
            <a href="{{ route('dashboard') }}" class="text-white bg-gray-800 px-4 py-2 rounded">Back to Dashboard</a>
        </div>
        <div class="fixed bottom-28 left-4">
            <a href="{{ route('courses.create') }}" class="btn btn-primary bg-blue-500 text-white px-4 py-2 rounded">Create New Course</a>
        </div>
    </div>
    <script>
        function openModal(courseId) {
            const modal = document.getElementById(`modal-${courseId}`);
            modal.classList.remove('hidden');
        }

        function closeModal(courseId) {
            const modal = document.getElementById(`modal-${courseId}`);
            modal.classList.add('hidden');
        }

        function openDescriptionModal(courseId) {
            const modal = document.getElementById(`description-modal-${courseId}`);
            modal.classList.remove('hidden');
        }

        function closeDescriptionModal(courseId) {
            const modal = document.getElementById(`description-modal-${courseId}`);
            modal.classList.add('hidden');
        }
    </script>
</body>
</html>
