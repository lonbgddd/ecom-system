<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->paginate(10);
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'nullable|numeric|min:0',
            'thumbnail'   => 'nullable|image|max:2048',
            'status'      => 'required|in:draft,published',
        ]);

        // Upload thumbnail
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request
                ->file('thumbnail')
                ->store('courses', 'public');
        }

        // Giá mặc định
        $data['price'] = $data['price'] ?? 0;

        // Slug không trùng
        $data['slug'] = $this->uniqueSlug($data['title']);

        $data['created_by'] = auth()->id();

        Course::create($data);

        return redirect()
            ->route('admin.courses.index')
            ->with('success', 'Tạo khoá học thành công');
    }

    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'nullable|numeric|min:0',
            'thumbnail'   => 'nullable|image|max:2048',
            'status'      => 'required|in:draft,published',
        ]);

        // Upload thumbnail mới
        if ($request->hasFile('thumbnail')) {
            if ($course->thumbnail) {
                Storage::disk('public')->delete($course->thumbnail);
            }

            $data['thumbnail'] = $request
                ->file('thumbnail')
                ->store('courses', 'public');
        }

        $data['price'] = $data['price'] ?? 0;

        // Chỉ đổi slug nếu đổi title
        if ($course->title !== $data['title']) {
            $data['slug'] = $this->uniqueSlug($data['title'], $course->id);
        }

        $course->update($data);

        return redirect()
            ->route('admin.courses.index')
            ->with('success', 'Cập nhật khoá học thành công');
    }

    public function destroy(Course $course)
    {
        if ($course->thumbnail) {
            Storage::disk('public')->delete($course->thumbnail);
        }

        $course->delete();

        return redirect()
            ->route('admin.courses.index')
            ->with('success', 'Đã xoá khoá học');
    }

    /**
     * Tạo slug không trùng
     */
    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $slug = Str::slug($title);
        $original = $slug;
        $i = 1;

        while (
            Course::where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = "{$original}-{$i}";
            $i++;
        }

        return $slug;
    }
}
