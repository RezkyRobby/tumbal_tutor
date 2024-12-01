<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    /**
     * Menampilkan daftar kursus yang diikuti oleh siswa yang login.
     */
    public function index()
{
    if (Auth::user()->role !== 'Student') {
        return redirect('/')->with('error', 'You do not have permission to view enrollments.');
    }

    $enrollments = Enrollment::where('user_id', Auth::id())
        ->with(['course', 'course.user']) // Include user pembuat course
        ->get();

    return view('enrollments.index', compact('enrollments'));
}

public function joinCourseForm()
{
    $courses = Course::with('user') // Pastikan 'teacher' digunakan, bukan 'user' (kebalik pakcik)
        ->whereDoesntHave('enrollments', function ($query) {
            $query->where('user_id', auth()->id());
        })
        ->get();

    return view('enrollments.join', compact('courses'));
}

    /**
     * Mendaftarkan siswa ke kursus yang dipilih.
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        // Pastikan hanya student yang bisa mendaftar
        if (Auth::user()->role !== 'Student') {
            return redirect()->back()->with('error', 'You do not have permission to enroll in this course.');
        }

        // Cek jika siswa sudah terdaftar di kursus ini
        $existingEnrollment = Enrollment::where([
            ['course_id', $request->course_id],
            ['user_id', Auth::id()],
        ])->first();

        if ($existingEnrollment) {
            return redirect()->back()->with('error', 'You are already enrolled in this course.');
        }

        Enrollment::create([
            'course_id' => $request->course_id,
            'user_id' => Auth::id(), // Ganti student_id dengan user_id
            'progress' => 0,
        ]);

        return redirect()->route('enrollments.index')->with('success', 'Successfully enrolled in course.');
    }

    /**
     * Menandai progres pada materi tertentu sebagai selesai.
     */
    public function markAsDone($id)
    {
        $enrollment = Enrollment::findOrFail($id);

        // Pastikan pengguna yang login adalah pemilik enrollment ini
        if ($enrollment->user_id !== Auth::id()) {
            return redirect()->route('enrollments.index')->with('error', 'You do not have permission to update this course progress.');
        }

        // Misalnya, kita anggap setiap `markAsDone` menambah progres sebesar 10%
        $enrollment->progress += 10;
        if ($enrollment->progress > 100) {
            $enrollment->progress = 100;
        }
        $enrollment->save();

        if ($enrollment->progress === 100) {
            // Generate sertifikat
            $certificateController = new CertificateController();
            $certificateController->generate($enrollment->id);
        }

        return redirect()->back()->with('success', 'Progress marked as completed.');
    }

    /**
     * Mengupdate progres belajar pengguna secara manual.
     */
    public function updateProgress(Request $request, $id)
    {
        $request->validate([
            'progress' => 'required|numeric|min:0|max:100',
        ]);

        $enrollment = Enrollment::findOrFail($id);

        // Pastikan pengguna yang login adalah pemilik enrollment ini
        if ($enrollment->user_id !== Auth::id()) {
            return redirect()->route('enrollments.index')->with('error', 'You do not have permission to update this course progress.');
        }

        // Update progres langsung
        $enrollment->progress = $request->progress;
        $enrollment->save();

        return redirect()->back()->with('success', 'Progress updated successfully.');
    }
}