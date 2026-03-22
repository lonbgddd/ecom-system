<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
     protected $fillable = ['title','description','price','slug', 'thumbnail', 'status', 'created_by'];

    public function resources()
{
    return $this->hasMany(CourseResource::class)->orderBy('order');
}

    public function orders() {
        return $this->hasMany(Order::class);
    }
}
