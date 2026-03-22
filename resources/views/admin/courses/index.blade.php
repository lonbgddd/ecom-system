<x-app-layout>
    {{-- Header --}}
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    Quản lý khoá học
                </h2>
                <p class="text-sm text-gray-500">
                    Danh sách các khoá học trong hệ thống
                </p>
            </div>

            <a href="{{ route('admin.courses.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg shadow hover:bg-blue-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Thêm khoá học
            </a>
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
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                            Khoá học
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                            Giá
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase w-56">
                            Hành động
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse($courses as $course)
                        <tr class="hover:bg-gray-50 transition">
                            {{-- Course --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <img
                                        src="{{ $course->thumbnail
                                            ? asset('storage/' . $course->thumbnail)
                                            : asset('images/default.png') }}"
                                        alt="Thumbnail"
                                        class="w-16 h-16 rounded-lg object-cover border"
                                    >

                                    <div>
                                        <div class="font-medium text-gray-800">
                                            {{ $course->title }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            Slug: {{ $course->slug }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            {{-- Price --}}
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2 py-1 text-sm font-medium rounded-md bg-blue-50 text-blue-700">
                                    {{ number_format($course->price) }} đ
                                </span>
                            </td>

                            {{-- Actions --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-3">

                                    <a href="{{ route('admin.courses.resources.index', $course) }}"
                                       class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                        Resources
                                    </a>

                                    <a href="{{ route('admin.courses.edit', $course) }}"
                                       class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        Sửa
                                    </a>

                                    <form action="{{ route('admin.courses.destroy', $course) }}"
                                          method="POST"
                                          onsubmit="return confirm('Bạn chắc chắn muốn xoá khoá học này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="text-red-600 hover:text-red-800 text-sm font-medium">
                                            Xoá
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-10 text-center text-gray-500">
                                Chưa có khoá học nào.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div>
            {{ $courses->links() }}
        </div>
    </div>
</x-app-layout>
