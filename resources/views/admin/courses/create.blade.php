<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    ➕ Thêm khoá học
                </h2>
                <p class="text-sm text-gray-500">
                    Tạo khoá học mới
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
                  action="{{ route('admin.courses.store') }}"
                  enctype="multipart/form-data"
                  class="p-8 space-y-6">
                @csrf

                {{-- Tên khoá học --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Tên khoá học
                    </label>
                    <input
                        name="title"
                        type="text"
                        value="{{ old('title') }}"
                        required
                        placeholder="VD: Laravel cơ bản cho người mới"
                        class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                    >
                </div>

                {{-- Thumbnail --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Ảnh thumbnail
                    </label>
                    <input
                        type="file"
                        name="thumbnail"
                        accept="image/*"
                        class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                    >
                    <p class="mt-1 text-xs text-gray-500">
                        JPG, PNG – tối đa 2MB
                    </p>
                </div>

                {{-- Mô tả --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Mô tả
                    </label>
                    <textarea
                        name="description"
                        rows="4"
                        placeholder="Giới thiệu ngắn về khoá học..."
                        class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                    >{{ old('description') }}</textarea>
                </div>

                {{-- Giá --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Giá (VNĐ)
                    </label>
                    <input
                        type="number"
                        name="price"
                        value="{{ old('price', 0) }}"
                        min="0"
                        class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                    >
                    <p class="mt-1 text-xs text-gray-500">
                        Để 0 nếu là khoá học miễn phí
                    </p>
                </div>

                {{-- Status --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Trạng thái
                    </label>
                    <select name="status"
                            class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        <option value="published">Hiển thị</option>
                        <option value="draft">Ẩn</option>
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
                        class="px-6 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700 transition">
                        Lưu khoá học
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
