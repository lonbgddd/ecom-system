<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseResource extends Model
{
    protected $fillable = [
        'course_id',
        'title',
        'file_path',
        'type',
        'order',
        'is_preview',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
