@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-6">Contents</h1>

    <a href="{{ route('contents.create') }}" class="btn btn-primary mb-4">Create New Content</a>

    <table class="table-auto w-full border-collapse border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2">#</th>
                <th class="border border-gray-300 px-4 py-2">Title</th>
                <th class="border border-gray-300 px-4 py-2">Media Type</th>
                <th class="border border-gray-300 px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($contents as $content)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $content->id }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $content->title }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ ucfirst($content->media_type) }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <a href="{{ route('contents.show', $content->id) }}" class="text-blue-500">View</a> |
                        <a href="{{ route('contents.edit', $content->id) }}" class="text-yellow-500">Edit</a> |
                        <form action="{{ route('contents.destroy', $content->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="border border-gray-300 px-4 py-2 text-center">No content found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
