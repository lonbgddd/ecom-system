<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    //
    public function index() {
        $courses = Course::whereHas('orders', function ($query) {
        $query->where('user_id', auth()->id())
              ->where('status', 'paid');
    })->get();

        
        return view('shop.courses.index', compact('courses'));
    }

    // Trang chi tiết khóa học
    public function show($slug) {
        $course = Course::where('slug', $slug)->firstOrFail();

        // Khóa học trả phí -> chỉ xem khi login
        if($course->price > 0 && !Auth::check()) {
            return redirect()->route('login')->with('warning','Đăng nhập để xem khóa học này');
        }

        // Nếu user đã mua hoặc miễn phí -> show resources
        $hasAccess = $course->price == 0 ||
            (Auth::check() && Auth::user()->orders()->where('course_id',$course->id)->exists());

        return view('courses.show', compact('course','hasAccess'));
    }

   public function purchase(Course $course)
{
    $user = Auth::user();

    $order = $user->orders()
        ->where('course_id', $course->id)
        ->first();

    // Đã tồn tại order
    if ($order) {

        if ($order->status === 'paid') {
            return back()->with('info', 'Bạn đã mua khóa học này.');
        }

        if ($order->status === 'pending') {
            return back()->with('info', 'Đơn hàng đang chờ admin duyệt.');
        }
    }

    // Tạo order mới
    $user->orders()->create([
        'course_id' => $course->id,
        'price' => $course->price,
        'status' => 'pending',
        'payment_method' => request('payment_method'),
    ]);

    return back()->with('success', 'Đơn hàng đã được gửi. Vui lòng chờ admin duyệt.');
}
}
