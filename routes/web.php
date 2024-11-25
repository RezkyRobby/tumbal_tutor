<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\NotificationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-pdf', function () {
    $pdf = Barryvdh\DomPDF\Facade\Pdf::loadHTML('<h1>Kontol ko pdf</h1>');
    return $pdf->stream('test.pdf');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [CourseController::class, 'dashboard'])->name('dashboard');
});

// Profil bisa diakses oleh semua pengguna yang login
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('certificates', CertificateController::class)->only(['index']);
    Route::get('certificates/{certificate}/download', [CertificateController::class, 'download'])->name('certificates.download');
    Route::post('certificates/generate/{enrollment}', [CertificateController::class, 'generate'])->name('certificates.generate');

    Route::patch('progress/{progress}', [ProgressController::class, 'update'])->name('progress.update');
    Route::post('progress/{content}/mark-as-done', [ProgressController::class, 'markAsDone'])->name('progress.markAsDone');

    Route::resource('notifications', NotificationController::class)->only(['index']);
    Route::post('notifications/{notification}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::delete('notifications/{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::resource('courses', CourseController::class);
    Route::resource('contents', ContentController::class);
    Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses.show');

});

// Middleware khusus Admin dan Teacher
Route::middleware(['auth', 'role:Admin,Teacher'])->group(function () {
    // Route::resource('courses', CourseController::class);
    // Route::resource('contents', ContentController::class);
});

// Middleware khusus Student
Route::middleware(['auth', 'role:Student'])->group(function () {
    Route::resource('enrollments', EnrollmentController::class)->only(['index', 'store']);
    Route::patch('enrollments/{enrollment}/progress', [EnrollmentController::class, 'updateProgress'])->name('enrollments.updateProgress');
    Route::post('enrollments/{enrollment}/mark-as-done', [EnrollmentController::class, 'markAsDone'])->name('enrollments.markAsDone');
    Route::get('/enrollments/join', [EnrollmentController::class, 'joinCourseForm'])->name('enrollments.join');
    Route::post('/enrollments', [EnrollmentController::class, 'store'])->name('enrollments.store');
});

require __DIR__.'/auth.php';