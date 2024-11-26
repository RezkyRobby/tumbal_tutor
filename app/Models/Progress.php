<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    protected $table = 'progresses'; // Nama tabel yang benar
    protected $fillable = [
        'enrollment_id',
        'content_id',
        'is_completed',
    ];

    // Relasi ke Enrollment
    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }

    // Relasi ke Content
    public function content()
    {
        return $this->belongsTo(Content::class);
    }
}
