<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    //
     public function index() {
        $courses = Course::all();
        
        return view('shop.courses.index', compact('courses'));
    }

    public function show($slug) {
           $course = Course::where('slug',$slug)
        ->with('resources')
        ->firstOrFail();

    $hasAccess = $course->price == 0 ||
        (Auth::check() &&
        Auth::user()->orders()
        ->where('course_id',$course->id)
        ->where('status','paid')
        ->exists());

    return view('shop.courses.show', compact('course','hasAccess'));
    }

}
