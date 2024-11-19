<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ContentController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Admin,Teacher');
    }
    public function index()
    {
        $contents = Content::all();
        return view('contents.index', compact('contents'));
    }

    public function create()
    {
        return view('contents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'media_type' => 'required|in:video,file,youtube',
            'media_path' => 'required_if:media_type,youtube|url',
        ]);

        $mediaPath = null;
        if ($request->media_type === 'video' || $request->media_type === 'file') {
            if ($request->hasFile('media_file')) {
                $mediaPath = $request->file('media_file')->store('content_media');
            }
        } else if ($request->media_type === 'youtube') {
            $mediaPath = $request->media_path;
        }

        Content::create([
            'title' => $request->title,
            'body' => $request->body,
            'course_id' => $request->course_id,
            'teacher_id' => auth()->id(),
            'media_type' => $request->media_type,
            'media_path' => $mediaPath,
        ]);

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
}
