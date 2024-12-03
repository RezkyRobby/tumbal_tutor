<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ContentController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Teacher,Admin')->only('index');

        $this->middleware('role:Admin,Teacher,Student')->except('index');
    }
    public function index()
    {
        $contents = Content::all();
        return view('contents.index', compact('contents'));
    }

    public function create()
    {
        $courses = Course::select('id', 'course_name')->get();
        return view('contents.create', compact('courses'));
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
            'media_type' => 'required|in:video,file,youtube',
            'media_path' => 'required_if:media_type,youtube|url|nullable', // Hanya untuk youtube
            'media_file' => 'required_if:media_type,video,file|file|nullable', // Untuk video dan file
        ]);

        $mediaPath = null;
        if ($request->media_type === 'video' || $request->media_type === 'file') {
            if ($request->hasFile('media_file')) {
                // dd($request->file('media_file')->getClientOriginalName());

                // Simpan file ke folder `storage/app/content_media`
                $mediaPath = $request->file('media_file')->store('content_media', 'public');
            } else {
                return redirect()->back()->withErrors(['media_file' => 'Please upload a valid file.']);
            }
        } else if ($request->media_type === 'youtube') {
            $mediaPath = $request->media_path;

            if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([\w\-]+)/', $mediaPath, $matches)) {
                $mediaPath = 'https://www.youtube.com/embed/' . $matches[1];
            } else {
                return redirect()->back()->withErrors(['media_path' => 'Invalid YouTube URL.']);
            }
        }

        Content::create([
            'course_id' => $request->course_id,
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => auth()->id(),
            'media_type' => $request->media_type,
            'media_path' => $mediaPath,
        ]);
        // dd('Content created successfully.');
        return redirect()->route('contents.index')->with('success', 'Content created successfully.');
    }

     // Menampilkan detail konten berdasarkan ID
     public function show($id)
     {
         $content = Content::findOrFail($id);
         return view('contents.show', compact('content'));
     }
 
     // Menampilkan form untuk mengedit konten berdasarkan ID
     public function edit($id)
     {
         $content = Content::findOrFail($id);
         return view('contents.edit', compact('content'));
     }
 
     // Memperbarui data konten di database
     public function update(Request $request, $id)
     {
         $request->validate([
             'title' => 'required|string|max:255',
             'body' => 'nullable|string',
             'media_type' => 'required|in:video,file,youtube',
             'media_path' => 'required_if:media_type,youtube|url',
         ]);
 
         $content = Content::findOrFail($id);
 
         // Mengelola path media tergantung pada tipe media yang di-upload atau di-embed
         $mediaPath = $content->media_path;
         if ($request->media_type === 'video' || $request->media_type === 'file') {
             if ($request->hasFile('media_file')) {
                 $mediaPath = $request->file('media_file')->store('content_media');
             }
         } elseif ($request->media_type === 'youtube') {
             $mediaPath = $request->media_path;
         }
 
         $content->update([
             'title' => $request->title,
             'body' => $request->body,
             'media_type' => $request->media_type,
             'media_path' => $mediaPath,
         ]);
 
         return redirect()->route('contents.index')->with('success', 'Content updated successfully.');
     }
 
     // Menghapus konten dari database berdasarkan ID
     public function destroy($id)
     {
         $content = Content::findOrFail($id);
         $content->delete();
 
         return redirect()->route('contents.index')->with('success', 'Content deleted successfully.');
     }

     public function view($id)
{
    $content = Content::with('course.enrollments')->findOrFail($id);

    // Periksa apakah pengguna telah bergabung dengan kursus
    $userEnrolled = $content->course->enrollments->where('user_id', auth()->id())->count();

    if (!$userEnrolled) {
        return redirect()->route('courses.show', $content->course_id)
            ->with('error', 'You must join the course to view this content.');
    }

    return view('contents.view', compact('content'));
}
}
