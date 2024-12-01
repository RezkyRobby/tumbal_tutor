<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CertificateController extends Controller
{
    /**
     * Menampilkan daftar sertifikat untuk siswa yang sedang login.
     */
    public function index()
{
    $certificates = Certificate::where('user_id', auth()->id())->with('course')->get();
    return view('certificates.index', compact('certificates'));
}

    /**
     * Mengunduh sertifikat dalam format PDF.
     */
    public function download($id)
    {
        $certificate = Certificate::findOrFail($id);

        // Pastikan sertifikat hanya bisa diunduh oleh pemiliknya
        if ($certificate->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access to this certificate.');
        }

        $pdf = Pdf::loadView('certificates.template', compact('certificate'));
        return $pdf->download('certificate-' . $certificate->id . '.pdf');
    }

    /**
     * Menghasilkan sertifikat untuk siswa setelah menyelesaikan kursus.
     */
    public function generate($enrollment_id)
{
    $enrollment = Enrollment::findOrFail($enrollment_id);

    // Pastikan siswa sudah menyelesaikan kursus
    if ($enrollment->user_id !== auth()->id() || $enrollment->progress < 100) {
        abort(403, 'You cannot generate a certificate for this course.');
    }

    // Cek jika sertifikat sudah ada
    $existingCertificate = Certificate::where('user_id', $enrollment->user_id)
        ->where('course_id', $enrollment->course_id)
        ->first();

    if ($existingCertificate) {
        return redirect()->route('certificates.index')->with('error', 'Certificate already exists.');
    }

    // Buat sertifikat baru
    $certificate = Certificate::create([
        'user_id' => $enrollment->user_id,
        'course_id' => $enrollment->course_id,
        'issued_at' => now(),
    ]);

    return redirect()->route('certificates.index')->with('success', 'Certificate generated successfully.');
}
}
