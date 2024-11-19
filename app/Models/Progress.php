<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    protected $fillable = [
        'enrollment_id',
        'content_id',
        'status',
        'completed_at',
    ];

    /**
     * Relasi ke Enrollment.
     */
    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }

    /**
     * Relasi ke Content.
     */
    public function content()
    {
        return $this->belongsTo(Content::class);
    }
}
