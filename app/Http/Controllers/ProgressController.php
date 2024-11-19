<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use App\Models\Content;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|boolean',
        ]);

        $progress = Progress::findOrFail($id);

        if ($progress->enrollment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access to this progress.');
        }

        $progress->update([
            'status' => $request->status,
            'completed_at' => $request->status ? now() : null,
        ]);

        return redirect()->back()->with('success', 'Progress updated successfully.');
    }

    public function markAsDone($content_id)
    {
        $content = Content::findOrFail($content_id);
        $enrollment = $content->course->enrollments->where('user_id', auth()->id())->first();

        if (!$enrollment) {
            abort(403, 'You are not enrolled in this course.');
        }

        $progress = Progress::firstOrCreate([
            'enrollment_id' => $enrollment->id,
            'content_id' => $content->id,
        ]);

        $progress->update([
            'status' => true,
            'completed_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Content marked as completed.');
    }
}
