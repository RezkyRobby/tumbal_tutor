<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\Course;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index()
    {
        $forums = Forum::with('course')->get();
        return view('forums.index', compact('forums'));
    }

    public function create()
    {
        $courses = Course::all(); // Pilih kursus terkait forum
        return view('forums.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'topic' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
        ]);
    
        $forum = Forum::create([
            'topic' => $request->topic,
            'course_id' => $request->course_id,
        ]);
    
        // Redirect ke halaman detail forum yang baru dibuat
        return redirect()->route('forums.show', $forum->id)->with('success', 'Forum created successfully.');
    }

    public function show($id)
    {
        $forum = Forum::with('discussions.user')->findOrFail($id); // Ambil forum dan diskusi terkait
        return view('forums.show', compact('forum'));
    }

    public function edit($id)
    {
        $forum = Forum::findOrFail($id);
        $courses = Course::all(); // Untuk memilih kursus saat mengedit
        return view('forums.edit', compact('forum', 'courses'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'topic' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
        ]);

        $forum = Forum::findOrFail($id);
        $forum->update([
            'topic' => $request->topic,
            'course_id' => $request->course_id,
        ]);

        return redirect()->route('forums.index')->with('success', 'Forum updated successfully.');
    }

    public function destroy($id)
    {
        $forum = Forum::findOrFail($id);
        $forum->delete();

        return redirect()->route('forums.index')->with('success', 'Forum deleted successfully.');
    }
}
