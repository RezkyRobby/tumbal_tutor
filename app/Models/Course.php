<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_name',
        'description',
        'start_date',
        'end_date',
        'teacher_id',
    ];

    /**
     * Relasi ke User (Teacher).
     */
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    /**
     * Relasi ke Content.
     */
    public function contents()
    {
        return $this->hasMany(Content::class);
    }

    /**
     * Relasi ke Enrollments.
     */
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * Relasi ke Forum.
     */
    public function forum()
    {
        return $this->hasOne(Forum::class);
    }
}
