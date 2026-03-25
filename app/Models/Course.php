<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';

    protected $fillable = [
        'title',
        'description',
        'price',
        'slug',
        'thumbnail',
        'status',
        'created_by'
    ];

    /**
     * CAST dữ liệu cho chuẩn
     */
    protected $casts = [
        'price' => 'decimal:2',
    ];

    /**
     * Quan hệ: Course -> User (người tạo)
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Quan hệ: Course -> CourseResource
     */
    public function resources()
    {
        return $this->hasMany(CourseResource::class)
                    ->orderBy('order');
    }

    /**
     * Quan hệ: Course -> Orders
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}