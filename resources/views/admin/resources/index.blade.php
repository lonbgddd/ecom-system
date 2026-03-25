<x-app-layout>
    {{-- Header --}}
<x-slot name="header">
    <div class="flex flex-col gap-4">

        {{-- Back --}}
        <div>
            <a href="{{ route('admin.courses.index') }}"
               class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-gray-800 font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Quay lại danh sách khoá học
            </a>
        </div>

        {{-- Title + Action --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    📚 {{ $course->title }}
                </h2>
                <p class="text-sm text-gray-500">
                    Quản lý danh sách bài học trong khoá học
                </p>
            </div>

            <a href="{{ route('admin.courses.resources.create', $course) }}"
               class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg shadow hover:bg-blue-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Thêm bài học
            </a>
        </div>

    </div>
</x-slot>


    <div class="p-6 space-y-6">

        {{-- Alert --}}
        @if(session('success'))
            <div class="rounded-lg bg-green-50 border border-green-200 p-4 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- Table --}}
        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase w-20">
                            Thứ tự
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                            Tiêu đề
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase w-32">
                            Loại
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase w-32">
                            Preview
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase w-48">
                            Hành động
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse($resources as $r)
                        <tr class="hover:bg-gray-50 transition">
                            {{-- Order --}}
                            <td class="px-6 py-4 font-medium text-gray-700">
                                {{ $r->order }}
                            </td>

                            {{-- Title --}}
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-800">
                                    {{ $r->title }}
                                </div>
                                <div class="text-xs text-gray-500 max-w-xs truncate" title="{{ $r->file_path }}">
    {{ $r->file_path }}
</div>
                            </td>

                            {{-- Type --}}
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-md
                                    @switch($r->type)
                                        @case('video') bg-purple-50 text-purple-700 @break
                                        @case('pdf') bg-red-50 text-red-700 @break
                                        @case('code') bg-gray-100 text-gray-700 @break
                                        @case('image') bg-green-50 text-green-700 @break
                                    @endswitch
                                ">
                                    {{ strtoupper($r->type) }}
                                </span>
                            </td>

                            {{-- Preview --}}
                            <td class="px-6 py-4 text-center">
                                @if($r->is_preview)
                                    <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-md bg-green-50 text-green-700">
                                        ✔ Có
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-md bg-gray-100 text-gray-500">
                                        ✖ Không
                                    </span>
                                @endif
                            </td>

                            {{-- Actions --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-3">
                                    <a href="{{ route('admin.courses.resources.edit', [$course, $r]) }}"
                                       class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        Sửa
                                    </a>

                                    <form method="POST"
                                          action="{{ route('admin.courses.resources.destroy', [$course, $r]) }}"
                                          onsubmit="return confirm('Bạn chắc chắn muốn xoá bài học này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 hover:text-red-800 text-sm font-medium">
                                            Xoá
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                                Khoá học này chưa có bài học nào.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
