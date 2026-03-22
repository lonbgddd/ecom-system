<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\ResourceController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Shop\CourseController;

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
            Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
        Route::resource('/courses', AdminCourseController::class);

        Route::resource('/courses.resources', ResourceController::class);

        Route::get('/orders', [OrderController::class, 'index'])
            ->name('orders.index');
        Route::post('/orders/{order}', [OrderController::class, 'approve'])
            ->name('orders.approve');
    });
Route::middleware(['auth', 'user'])

    ->group(function () {
       // Route::resource('shop', ShopController::class);
        Route::get('/courses', [CourseController::class, 'index'])->name('user.courses');
        Route::get('/courses/{slug}', [CourseController::class, 'show'])->name('coursesDetail');
        Route::post('/courses/{course}/purchase', [CourseController::class, 'purchase'])->name('courses.buy');
    });

// use App\Http\Controllers\Shop\CourseController;

// Route::get('/courses', [CourseController::class,'index'])->name('courses.index');
// Route::get('/courses/{slug}', [CourseController::class,'show'])->name('courses.show');

// Route::middleware('auth')->group(function(){
//     Route::post('/courses/{course}/purchase', [CourseController::class,'purchase'])->name('courses.purchase');
// });

require __DIR__.'/auth.php';