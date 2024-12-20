<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'body', 'course_id', 'user_id', 'media_type', 'media_path'
    ];

    /**
     * Relasi ke Course.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
