<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;

    protected $fillable = ['topic', 'course_id'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function discussions()
    {
        return $this->hasMany(Discussion::class);
    }
}