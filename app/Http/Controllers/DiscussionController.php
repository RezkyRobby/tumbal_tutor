<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Models\Forum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscussionController extends Controller
{
    public function store(Request $request, $forum_id)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $forum = Forum::findOrFail($forum_id);

        Discussion::create([
            'forum_id' => $forum->id,
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        return redirect()->route('forums.show', $forum->id)->with('success', 'Discussion added successfully.');
    }

    public function edit($id)
    {
        $discussion = Discussion::findOrFail($id);

        // Pastikan hanya pemilik diskusi atau admin/teacher yang dapat mengedit
        if ($discussion->user_id !== Auth::id() && !in_array(Auth::user()->role, ['Admin', 'Teacher'])) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        return view('discussions.edit', compact('discussion'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $discussion = Discussion::findOrFail($id);

        // Pastikan hanya pemilik diskusi atau admin/teacher yang dapat mengupdate
        if ($discussion->user_id !== Auth::id() && !in_array(Auth::user()->role, ['Admin', 'Teacher'])) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        $discussion->update([
            'message' => $request->message,
        ]);

        return redirect()->route('forums.show', $discussion->forum_id)->with('success', 'Discussion updated successfully.');
    }

    public function destroy($id)
    {
        $discussion = Discussion::findOrFail($id);

        // Pastikan hanya pemilik diskusi atau admin/teacher yang dapat menghapus
        if ($discussion->user_id !== Auth::id() && !in_array(Auth::user()->role, ['Admin', 'Teacher'])) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        $discussion->delete();

        return redirect()->route('forums.show', $discussion->forum_id)->with('success', 'Discussion deleted successfully.');
    }
}
