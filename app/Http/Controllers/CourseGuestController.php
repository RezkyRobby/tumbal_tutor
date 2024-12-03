<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseGuestController extends Controller
{
    // Menampilkan daftar semua kursus untuk tamu
    public function index()
    {
        $courses = Course::all(); // Ambil semua kursus
        return view('welcome', compact('courses')); // Kirim data kursus ke tampilan welcome
    }
}
