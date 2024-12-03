<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>
    <link href="https://unpkg.com/flowbite@1.4.7/dist/flowbite.min.css" rel="stylesheet"/>
    <title>My Enrollments</title>
    {{-- <style>
        .dataTable-info {
            font-size: 0.875rem; /* Tailwind's 'text-sm' */
            color: #4B5563; /* Tailwind's 'text-gray-600' */
            margin-top: 1rem; /* Tailwind's 'mt-4' */
            text-align: center;
        }
        .dataTable-pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem; /* Tailwind's 'space-x-2' */
        }
        .dataTable-pagination .active {
            background-color: #4F46E5; /* Tailwind's 'bg-indigo-600' */
            color: white;
            border-radius: 0.375rem; /* Tailwind's 'rounded-md' */
        }
        .dataTable-pagination a {
            padding: 0.25rem 0.5rem; /* Tailwind's 'px-2 py-1' */
            border-radius: 0.375rem; /* Tailwind's 'rounded-md' */
            text-decoration: none;
            color: #4B5563; /* Tailwind's 'text-gray-600' */
        }
        .dataTable-pagination a:hover {
            background-color: #E5E7EB; /* Tailwind's 'hover:bg-gray-200' */
        }
    </style> --}}
</head>
<body>
    @include('components.navbar')
    
    <div class="container mt-20 p-4">
        <h1 class="text-xl font-bold text-center mb-6">My Enrollments</h1>

        @if (session('success'))
            <p class="text-green-500 text-center">{{ session('success') }}</p>
        @endif

        @if (session('error'))
            <p class="text-red-500 text-center">{{ session('error') }}</p>
        @endif

        <div class="overflow-x-auto shadow-md rounded-lg mt-4">
            <table id="enrollments-table" class="table-auto border-collapse border border-gray-200 w-full text-sm text-left text-gray-600">
                <thead class="bg-gray-100 text-gray-700 uppercase">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">Course Name</th>
                        <th class="border border-gray-300 px-4 py-2">Instructor</th>
                        <th class="border border-gray-300 px-4 py-2">Progress</th>
                        <th class="border border-gray-300 px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($enrollments as $enrollment)
                        <tr class="hover:bg-gray-100">
                            <td class="border border-gray-300 px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                                {{ $enrollment->course->course_name }}
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                {{ $enrollment->course->user->username ?? 'Unknown' }}
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                {{ $enrollment->progress }}%
                            </td>
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                <a href="{{ route('courses.contents', $enrollment->course->id) }}" class="text-black hover:underline">View Contents</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Script Datatables -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (document.getElementById("enrollments-table") && typeof simpleDatatables.DataTable !== 'undefined') {
                const dataTable = new simpleDatatables.DataTable("#enrollments-table", {
                    searchable: true,
                    perPageSelect: [5, 10, 20],
                    perPage: 5,
                });
            }
        });
    </script>
</body>
</html>
