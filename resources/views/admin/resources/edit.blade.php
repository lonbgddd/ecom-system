<x-app-layout>
    <x-slot name="header">
        <div class="text-center">
            <h2 class="text-2xl font-bold text-gray-800">
                ✏️ Sửa bài học
            </h2>
            <p class="text-sm text-gray-500">
                Khoá học: {{ $course->title }}
            </p>
        </div>
    </x-slot>

    <div class="p-6">
        <div class="max-w-2xl mx-auto bg-white border border-gray-200 rounded-xl shadow-sm p-8">
            <form method="POST"
                  action="{{ route('admin.courses.resources.update', [$course, $resource]) }}"
                  enctype="multipart/form-data"
                  class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Title --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Tiêu đề bài học
                    </label>
                    <input name="title"
                           value="{{ old('title', $resource->title) }}"
                           required
                           class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                </div>

                {{-- Current file --}}
                <div class="text-sm text-gray-600">
                    <strong>Nguồn hiện tại:</strong>
                    @if(Str::startsWith($resource->file_path, 'http'))
                        <a href="{{ $resource->file_path }}"
                           target="_blank"
                           class="text-blue-600 underline">
                            {{ $resource->file_path }}
                        </a>
                    @else
                        <span class="text-gray-500">
                            {{ $resource->file_path }}
                        </span>
                    @endif
                </div>

                {{-- Upload new file --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Upload file mới (tuỳ chọn)
                    </label>
                    <input type="file"
                           name="file"
                           class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    <p class="text-xs text-gray-500 mt-1">
                        Nếu upload file mới, file/link cũ sẽ bị thay thế
                    </p>
                </div>

                {{-- OR link --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Hoặc nhập link mới (tuỳ chọn)
                    </label>
                    <input name="file_path"
                           placeholder="https://..."
                           class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                </div>

                {{-- Type --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Loại bài học
                    </label>
                    <select name="type"
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        @foreach(['video','pdf','code','image'] as $type)
                            <option value="{{ $type }}"
                                @selected($resource->type === $type)>
                                {{ strtoupper($type) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Order --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Thứ tự hiển thị
                    </label>
                    <input type="number"
                           name="order"
                           value="{{ old('order', $resource->order) }}"
                           class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                </div>

                {{-- Preview --}}
                <div class="flex items-center gap-2">
                    <input type="checkbox"
                           name="is_preview"
                           value="1"
                           @checked($resource->is_preview)
                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <label class="text-sm text-gray-700">
                        Cho phép xem trước
                    </label>
                </div>

                {{-- Actions --}}
                <div class="flex justify-end gap-3 pt-6">
                    <a href="{{ route('admin.courses.resources.index', $course) }}"
                       class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100">
                        Huỷ
                    </a>

                    <button
                        class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 shadow">
                        Cập nhật bài học
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
