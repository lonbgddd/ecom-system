<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Danh sách khóa học IoT') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($courses as $course)
                        <div class="border rounded-lg p-4 shadow hover:shadow-md transition">
                            <h3 class="font-bold text-lg">{{ $course->title }}</h3>
                            <p class="text-gray-600 mt-2">{{ Str::limit($course->description, 100) }}</p>
                            <p class="mt-2">
                                @if($course->price == 0)
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded">Miễn phí</span>
                                @else
                                    <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded">{{ number_format($course->price) }}₫</span>
                                @endif
                            </p>
                            <a href="{{ route('coursesDetail', $course->slug) }}" class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                Xem chi tiết
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
