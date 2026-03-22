{{-- resources/views/admin/resources/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="text-center">
            <h2 class="text-2xl font-bold">➕ Thêm bài học</h2>
            <p class="text-sm text-gray-500">{{ $course->title }}</p>
        </div>
    </x-slot>

    <div class="p-6">
        <div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow">
            <form method="POST"
                  action="{{ route('admin.courses.resources.store', $course) }}"
                  enctype="multipart/form-data"
                  x-data="{ mode: 'upload' }"
                  class="space-y-6">
                @csrf

                {{-- Title --}}
                <input name="title"
                       required
                       placeholder="Tiêu đề bài học"
                       class="w-full rounded-lg border-gray-300">

                {{-- Type --}}
                <select name="type" class="w-full rounded-lg border-gray-300">
                    <option value="video">Video</option>
                    <option value="pdf">PDF</option>
                    <option value="code">Code</option>
                    <option value="image">Image</option>
                </select>

                {{-- Source selector --}}
                <div class="flex gap-6">
                    <label class="flex items-center gap-2">
                        <input type="radio" x-model="mode" value="upload">
                        Upload file
                    </label>
                    <label class="flex items-center gap-2">
                        <input type="radio" x-model="mode" value="url">
                        Dùng link
                    </label>
                </div>

                {{-- Upload --}}
                <div x-show="mode === 'upload'">
                    <input type="file" name="file"
                           class="w-full border p-2 rounded">
                </div>

                {{-- URL --}}
                <div x-show="mode === 'url'">
                    <input name="file_path"
                           placeholder="https://example.com/video.mp4"
                           class="w-full border p-2 rounded">
                </div>

                {{-- Order --}}
                <input type="number" name="order" value="0"
                       class="w-full rounded-lg border-gray-300">

                {{-- Preview --}}
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="is_preview" value="1">
                    Cho xem trước
                </label>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('admin.courses.resources.index', $course) }}"
                       class="px-4 py-2 border rounded">Huỷ</a>
                    <button class="px-6 py-2 bg-blue-600 text-white rounded">
                        Lưu
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
