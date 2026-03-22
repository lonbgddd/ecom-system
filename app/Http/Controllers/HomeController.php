<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class HomeController extends Controller
{
    //
    public function index()  {
         $courses = Course::where('status', 'published')
            ->latest()
            ->get();

        return view('home.index', compact('courses'));
    }
}
