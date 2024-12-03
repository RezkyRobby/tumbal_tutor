@extends('layouts.app')

@section('content')
<div class="container mt-20 p-4">
    <!-- Tabel Dinamis -->
    <h2 class="mt-6 text-xl font-semibold text-center text-gray-800">Contents Overview</h2>
    <div class="overflow-x-auto shadow-md rounded-lg mt-4">
        <table id="default-table" class="table-auto border-collapse border border-gray-200 w-full text-sm text-left text-gray-600">
            <thead class="bg-gray-100 text-gray-700 uppercase">
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Content Title</th>
                    <th class="border border-gray-300 px-4 py-2">Media Type</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($course->contents as $content)
                    <tr class="hover:bg-gray-100">
                        <td class="border border-gray-300 px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                            {{ $content->title }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">{{ $content->media_type }}</td>
                        
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <a href="{{ route('contents.view', $content->id) }}" class="text-black hover:underline">View Content</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Script Datatables -->
    <script src="https://unpkg.com/simple-datatables@latest" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (document.getElementById("default-table") && typeof simpleDatatables.DataTable !== 'undefined') {
                const dataTable = new simpleDatatables.DataTable("#default-table", {
                    searchable: false, // Mengaktifkan fitur pencarian
                    perPageSelect: [5, 10, 20], // Pilihan jumlah entri per halaman
                    perPage: 5 // Default entri per halaman
                });
            }
        });
    </script>

    <div class="flex justify-center mt-6">
        <a href="{{ route('enrollments.index') }}" class="bg-green-300 hover:bg-blue-300 text-white font-bold py-2 px-4 rounded">
            Go Back to Enrollments
        </a>
    </div>
</div>
@endsection
