<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $course->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p class="text-gray-700 mb-4">{{ $course->description }}</p>

                @if($course->price == 0)
                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded">Miễn phí</span>
                @else
                    <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded">{{ number_format($course->price) }}₫</span>
                @endif

                <div class="mt-6">
                    @if($hasAccess)
                        <h4 class="font-semibold mb-2">Tài nguyên khóa học</h4>
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach($course->resources as $res)
                                <li>
                                    <a href="{{ asset('storage/'.$res->file_path) }}" target="_blank" class="text-blue-600 hover:underline">
                                        {{ $res->title }} ({{ $res->type }})
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @elseif($course->price > 0)
                        @auth
                            <form action="{{ route('courses.purchase', $course->id) }}" method="POST" class="mt-4">
                                @csrf
                                <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                                    Mua khóa học
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                Đăng nhập để mua
                            </a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
