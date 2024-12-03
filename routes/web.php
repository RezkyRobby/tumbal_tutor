<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\CourseGuestController;

// Halaman landing
Route::get('/', [CourseGuestController::class, 'index'])->name('welcome');

// Tes PDF
Route::get('/test-pdf', function () {
    $pdf = Barryvdh\DomPDF\Facade\Pdf::loadHTML('<h1>Kontol ko pdf</h1>');
    return $pdf->stream('test.pdf');
});

// Middleware autentikasi
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [CourseController::class, 'dashboard'])->name('dashboard');

    // Profil
    Route::get('profile/edit', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::patch('profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::delete('/profile', [UserController::class, 'destroy'])->name('profile.destroy')->middleware('auth');

    // Sertifikat
    Route::resource('certificates', CertificateController::class)->only(['index']);
    Route::get('certificates/{certificate}/download', [CertificateController::class, 'download'])->name('certificates.download');
    Route::post('certificates/generate/{enrollment}', [CertificateController::class, 'generate'])->name('certificates.generate');

    // Progres
    Route::patch('progress/{progress}', [ProgressController::class, 'update'])->name('progress.update');
    Route::post('progress/{content}/mark-as-done', [ProgressController::class, 'markAsDone'])->name('progress.markAsDone');

    // Notifikasi
    Route::resource('notifications', NotificationController::class)->only(['index']);
    Route::post('notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::delete('notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');

    // Kursus
    Route::get('/courses/all', [CourseController::class, 'showAll'])->name('courses.showAll');
    Route::get('/courses/search', [CourseController::class, 'search'])->name('courses.search');
    // Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses.show');
    Route::resource('courses', CourseController::class);
    Route::get('/courses/{id}/contents', [CourseController::class, 'viewContents'])->name('courses.contents');

    // Konten
    Route::get('/contents/create', [ContentController::class, 'create'])->name('contents.create');
    Route::get('/contents/{id}', [ContentController::class, 'view'])->name('contents.view');
    Route::resource('contents', ContentController::class);

    // Forums
    Route::resource('forums', ForumController::class);
    Route::get('courses/{course}/forums/create', [ForumController::class, 'create'])->name('forums.create');
    Route::post('forums/{forum}/discussions', [DiscussionController::class, 'store'])->name('discussions.store');
    Route::delete('discussions/{discussion}', [DiscussionController::class, 'destroy'])->name('discussions.destroy');
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

Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::patch('users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::resource('users', UserController::class);
});

// Memuat file auth
require __DIR__.'/auth.php';