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

Route::get('/pdf/{id}', function ($id) {
    $resource = \App\Models\CourseResource::findOrFail($id);

    $path = storage_path('app/private/' . $resource->file_path);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
})->name('pdf.view');

Route::get('/video/{id}', function ($id) {

    $resource = \App\Models\CourseResource::findOrFail($id);
    $path = storage_path('app/private/' . $resource->file_path);

    if (!file_exists($path)) {
        abort(404);
    }

    $size   = filesize($path);
    $stream = fopen($path, 'rb');

    $start = 0;
    $end   = $size - 1;

    // 🔥 Handle Range (QUAN TRỌNG)
    if (request()->hasHeader('Range')) {
        $range = request()->header('Range');
        preg_match('/bytes=(\d+)-(\d*)/', $range, $matches);

        $start = intval($matches[1]);
        if (!empty($matches[2])) {
            $end = intval($matches[2]);
        }
    }

    $length = $end - $start + 1;

    fseek($stream, $start);

    return response()->stream(function () use ($stream, $length) {
        $buffer = 1024 * 8;

        while (!feof($stream) && $length > 0) {
            $read = ($length > $buffer) ? $buffer : $length;
            $length -= $read;
            echo fread($stream, $read);
            flush();
        }

        fclose($stream);
    }, request()->hasHeader('Range') ? 206 : 200, [
        'Content-Type' => 'video/mp4',
        'Content-Length' => $length,
        'Accept-Ranges' => 'bytes',
        'Content-Range' => "bytes $start-$end/$size",
    ]);
})->name('video.stream');
require __DIR__.'/auth.php';