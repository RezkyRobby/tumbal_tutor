<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>
    <link href="https://unpkg.com/flowbite@1.4.7/dist/flowbite.min.css" rel="stylesheet"/>
    <title>User Management</title>
</head>
<body>
    @include('components.navbar')

    <div class="container mx-auto mt-20 p-4">
        <h1 class="text-2xl font-bold text-center mb-6">User Management</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4 text-center">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto shadow-md rounded-lg mt-4">
            <table id="users-table" class="table-auto border-collapse border border-gray-200 w-full text-sm text-left text-gray-600">
                <thead class="bg-gray-100 text-gray-700 uppercase">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">Username</th>
                        <th class="border border-gray-300 px-4 py-2">Email</th>
                        <th class="border border-gray-300 px-4 py-2">Role</th>
                        <th class="border border-gray-300 px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-100">
                            <td class="border border-gray-300 px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                                {{ $user->username }}
                            </td>
                            <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $user->role }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                <a href="{{ route('users.edit', $user) }}" class="text-blue-500 hover:underline">Edit</a>
                                <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (document.getElementById("users-table") && typeof simpleDatatables.DataTable !== 'undefined') {
                const dataTable = new simpleDatatables.DataTable("#users-table", {
                    searchable: true,
                    perPageSelect: [5, 10, 20],
                    perPage: 5,
                });
            }
        });
    </script>
</body>
</html>
