<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CourseController extends Controller
{
    public function __construct()
    {
        // Batasi akses ke metode 'index' hanya untuk Teacher
        $this->middleware('role:Teacher,Admin')->only('index');

        // Semua pengguna (Admin, Teacher, Student) dapat mengakses metode selain 'index'
        $this->middleware('role:Admin,Teacher,Student')->except('index');
    }
    
    // Menampilkan daftar semua kursus

public function index()
{
    $courses = Course::with(['enrollments' => function ($query) {
        $query->with('user'); // Mengambil data user yang terdaftar
    }])->get();

    return view('courses.index', compact('courses'));
}


    // Menampilkan form untuk membuat kursus baru
    public function create()
    {
        return view('courses.create');
    }

    // Menyimpan kursus baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'course_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        Course::create([
            'course_name' => $request->course_name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    }

    // Menampilkan detail kursus berdasarkan ID
    public function show($id)
{
    $course = Course::with(['enrollments.user', 'contents', 'forums.discussions.user'])->findOrFail($id);
    return view('courses.show', compact('course'));
}

    // Menampilkan form untuk mengedit kursus berdasarkan ID
    public function edit($id)
    {
        $course = Course::findOrFail($id);

        if (!$this->authorizeCourseAction($course)) {
            abort(403, 'You are not authorized to edit this course.');
        }

        return view('courses.edit', compact('course'));
    }

    // Memperbarui data kursus di database
    public function update(Request $request, $id)
    {
        $request->validate([
            'course_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $course = Course::findOrFail($id);

        if (!$this->authorizeCourseAction($course)) {
            abort(403, 'You are not authorized to update this course.');
        }

        $course->update([
            'course_name' => $request->course_name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        foreach ($course->enrollments as $enrollment) {
            NotificationController::createNotification(
                $enrollment->user_id,
                "Course Updated: {$course->course_name}",
                "The course '{$course->course_name}' has been updated.",
                $course->id
            );
        }
    

        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }

    // Menghapus kursus dari database berdasarkan ID
    public function destroy($id)
    {
        $course = Course::findOrFail($id);

        if (!$this->authorizeCourseAction($course)) {
            abort(403, 'You are not authorized to delete this course.');
        }

        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }

    public function dashboard()
{
    $popularCourses = Course::withCount(['enrollments' => function ($query) {
        $query->whereHas('user', function ($subQuery) {
            $subQuery->where('role', 'Student'); // Hanya menghitung Student
        });
    }])
    ->orderBy('enrollments_count', 'desc') // Urutkan berdasarkan jumlah enrollments
    ->take(5) // Ambil 5 kursus teratas
    ->get();
    $allCourses = Course::all(); // Fetch all courses

    return view('dashboard', compact('popularCourses', 'allCourses'));
}

public function viewContents($id)
{
    $course = Course::with('contents')->findOrFail($id);

    return view('courses.contents', compact('course'));
}


    /**
     * Fungsi untuk memeriksa apakah user memiliki akses untuk mengedit/menghapus kursus.
     */
    private function authorizeCourseAction(Course $course): bool
    {
        $user = auth()->user();

        // Hanya Admin atau Teacher yang membuat course yang dapat mengedit/menghapus
        return $user->hasRole('Admin') || ($user->hasRole('Teacher') && $course->user_id === $user->id);
    }

    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required|string|max:255',
        ]);
    
        $searchTerm = $request->input('search');
        $courses = Course::where('course_name', 'LIKE', "%{$searchTerm}%")
            ->orWhere('description', 'LIKE', "%{$searchTerm}%")
            ->get();
    
        return view('courses.search', compact('courses')); // Mengarahkan ke courses.search
    }
}
