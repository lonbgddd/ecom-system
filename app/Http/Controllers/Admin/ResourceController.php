<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseResource;
use Illuminate\Support\Facades\Storage;

class ResourceController extends Controller
{
    public function index(Course $course)
    {
        $resources = $course->resources()->orderBy('order')->get();
        return view('admin.resources.index', compact('course', 'resources'));
    }

    public function create(Course $course)
    {
        return view('admin.resources.create', compact('course'));
    }

    public function store(Request $request, Course $course)
    {
        $data = $request->validate([
            'title'      => 'required|string',
            'type'       => 'required|in:video,pdf,code,image',
            'order'      => 'nullable|integer',
            'is_preview' => 'nullable|boolean',
            'file'       => 'nullable|file',
            'file_path'  => 'nullable|string',
        ]);

        // ❗ BẮT BUỘC: file HOẶC link
        if (!$request->hasFile('file') && empty($data['file_path'])) {
            return back()->withErrors([
                'file' => 'Vui lòng upload file hoặc nhập link'
            ])->withInput();
        }

        // Upload file hoặc dùng link
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store(path: 'course_resources');
        } else {
            $path = $data['file_path'];
        }

        $course->resources()->create([
            'title'      => $data['title'],
            'file_path' => $path,
            'type'       => $data['type'],
            'order'      => $data['order'] ?? 0,
            'is_preview' => $request->boolean('is_preview'),
        ]);

        return redirect()
            ->route('admin.courses.resources.index', $course)
            ->with('success', 'Thêm bài học thành công');
    }

    public function edit(Course $course, CourseResource $resource)
    {
        return view('admin.resources.edit', compact('course', 'resource'));
    }

    public function update(Request $request, Course $course, CourseResource $resource)
    {
        $data = $request->validate([
            'title'      => 'required|string',
            'type'       => 'required|in:video,pdf,code,image',
            'order'      => 'nullable|integer',
            'is_preview' => 'nullable|boolean',
            'file'       => 'nullable|file',
            'file_path'  => 'nullable|string',
        ]);

        // Nếu upload file mới
        if ($request->hasFile('file')) {
            if ($resource->file_path && !str_starts_with($resource->file_path, 'http')) {
                Storage::delete($resource->file_path);
            }
            $resource->file_path = $request->file('file')->store('course_resources');
        }
        // Nếu nhập link mới
        elseif (!empty($data['file_path'])) {
            $resource->file_path = $data['file_path'];
        }

        $resource->update([
            'title'      => $data['title'],
            'type'       => $data['type'],
            'order'      => $data['order'] ?? 0,
            'is_preview' => $request->boolean('is_preview'),
        ]);

        return redirect()
            ->route('admin.courses.resources.index', $course)
            ->with('success', 'Cập nhật bài học thành công');
    }

    public function destroy(Course $course, CourseResource $resource)
    {
        if ($resource->file_path && !str_starts_with($resource->file_path, 'http')) {
            Storage::delete($resource->file_path);
        }

        $resource->delete();

        return back()->with('success', 'Đã xoá bài học');
    }
}
