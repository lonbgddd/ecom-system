<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    ✏️ Sửa khoá học
                </h2>
                <p class="text-sm text-gray-500">
                    {{ $course->title }}
                </p>
            </div>

            <a href="{{ route('admin.courses.index') }}"
               class="text-sm text-gray-600 hover:text-gray-900">
                ← Quay lại danh sách
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-sm border">
            <form method="POST"
                  action="{{ route('admin.courses.update', $course) }}"
                  enctype="multipart/form-data"
                  class="p-8 space-y-6">
                @csrf
                @method('PUT')

                {{-- Tên khoá học --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Tên khoá học
                    </label>
                    <input
                        type="text"
                        name="title"
                        value="{{ old('title', $course->title) }}"
                        required
                        class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                    >
                    @error('title')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Thumbnail --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Ảnh thumbnail
                    </label>

                    @if($course->thumbnail)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $course->thumbnail) }}"
                                 alt="Thumbnail"
                                 class="h-32 rounded-lg border">
                        </div>
                    @endif

                    <input
                        type="file"
                        name="thumbnail"
                        accept="image/*"
                        class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                    >
                    <p class="mt-1 text-xs text-gray-500">
                        Chọn ảnh mới nếu muốn thay đổi
                    </p>

                    @error('thumbnail')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Mô tả --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Mô tả
                    </label>
                    <textarea
                        name="description"
                        rows="4"
                        class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                    >{{ old('description', $course->description) }}</textarea>
                    @error('description')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Giá --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Giá (VNĐ)
                    </label>
                    <input
                        type="number"
                        name="price"
                        min="0"
                        value="{{ old('price', $course->price) }}"
                        class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                    >
                    @error('price')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Trạng thái
                    </label>
                    <select
                        name="status"
                        class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        <option value="published" @selected($course->status == 'published')>
                            Hiển thị
                        </option>
                        <option value="draft" @selected($course->status == 'draft')>
                            Ẩn
                        </option>
                    </select>
                </div>

                {{-- Actions --}}
                <div class="flex justify-end gap-3 pt-4">
                    <a href="{{ route('admin.courses.index') }}"
                       class="px-4 py-2 rounded-md border text-gray-700 hover:bg-gray-100">
                        Huỷ
                    </a>

                    <button
                        type="submit"
                        class="px-6 py-2 rounded-md bg-green-600 text-white hover:bg-green-700 transition">
                        💾 Cập nhật
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
