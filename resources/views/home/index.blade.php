<x-guest-layout>
    <x-slot:title>
        EduCourse – Nền tảng học lập trình
    </x-slot:title>

    {{-- ================= HERO ================= --}}
    <section class="bg-gradient-to-br from-indigo-600 to-purple-600 text-white">
        <div class="max-w-7xl mx-auto px-6 py-28 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">
                Học lập trình online <br class="hidden md:block">
                từ cơ bản đến nâng cao
            </h1>

            <p class="max-w-2xl mx-auto text-indigo-100 mb-10">
                Nền tảng học PHP, Laravel & Fullstack Web với lộ trình rõ ràng,
                bài giảng thực tế và tài nguyên đi kèm.
            </p>

            <div class="flex justify-center gap-4">
                <a href="#courses"
                   class="px-8 py-3 bg-white text-indigo-600 rounded-lg font-semibold hover:bg-indigo-50 transition">
                    Khám phá khoá học
                </a>

                @guest
                    <a href="{{ route('register') }}"
                       class="px-8 py-3 border border-white rounded-lg hover:bg-white hover:text-indigo-600 transition">
                        Bắt đầu miễn phí
                    </a>
                @endguest
            </div>
        </div>
    </section>

    {{-- ================= FEATURES ================= --}}
    <section class="bg-white py-20">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-3 gap-10 text-center">
                <div>
                    <div class="text-indigo-600 text-4xl mb-4">📚</div>
                    <h3 class="font-semibold text-lg mb-2">Lộ trình rõ ràng</h3>
                    <p class="text-gray-600 text-sm">
                        Học từ cơ bản đến nâng cao, không lan man
                    </p>
                </div>

                <div>
                    <div class="text-indigo-600 text-4xl mb-4">💡</div>
                    <h3 class="font-semibold text-lg mb-2">Thực hành thực tế</h3>
                    <p class="text-gray-600 text-sm">
                        Xây dựng dự án thật, áp dụng ngay
                    </p>
                </div>

                <div>
                    <div class="text-indigo-600 text-4xl mb-4">🎓</div>
                    <h3 class="font-semibold text-lg mb-2">Tài nguyên đầy đủ</h3>
                    <p class="text-gray-600 text-sm">
                        Video, source code, tài liệu đính kèm
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="courses" class="bg-gray-50 py-24">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold mb-4">
                    Tất cả khoá học
                </h2>
                <p class="text-gray-600">
                    Chọn khoá học phù hợp với bạn
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($courses as $course)

                        @php
                            $courseUrl = auth()->check()
                                ? route('coursesDetail', $course->slug)
                                : route('login');
                        @endphp

                    <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition overflow-hidden">

                        {{-- Thumbnail --}}
                        <a href="{{ $courseUrl }}">
                        <div class="h-44 bg-gray-200 flex items-center justify-center text-gray-400">
                            @if($course->thumbnail)
                                <img src="{{ asset('storage/'.$course->thumbnail) }}"
                                     class="w-full h-full object-cover">
                            @else
                                Thumbnail
                            @endif
                        </div>
                        </a>

                        <div class="p-6 flex flex-col h-full">
                            <h3 class="font-semibold text-lg mb-2">
                                {{ $course->title }}
                            </h3>

                            <p class="text-sm text-gray-600 mb-4 line-clamp-3">
                                {{ $course->description }}
                            </p>

                            <div class="mt-auto flex items-center justify-between">
                                <span class="font-bold text-indigo-600">
                                    {{ $course->price == 0 ? 'Miễn phí' : number_format($course->price).'₫' }}
                                </span>

                                @auth
                                    <a href="{{ route('coursesDetail', $course->slug) }}"
                                       class="text-sm font-medium text-indigo-600 hover:underline">
                                        Xem chi tiết →
                                    </a>
                                @else
                                    <a href="{{ route('login') }}"
                                       class="text-sm font-medium text-gray-500 hover:text-indigo-600">
                                        Đăng nhập →
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500">
                        Chưa có khoá học nào.
                    </p>
                @endforelse
            </div>
        </div>
    </section>
    {{-- ================= ABOUT ================= --}}
<section id="about" class="bg-white py-24">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid md:grid-cols-2 gap-12 items-center">

            {{-- Content --}}
            <div>
                <h2 class="text-3xl font-bold mb-6">
                    Về EduCourse
                </h2>

                <p class="text-gray-600 mb-4 leading-relaxed">
                    EduCourse là nền tảng học lập trình trực tuyến dành cho người mới
                    và lập trình viên muốn nâng cao kỹ năng thực tế.
                </p>

                <p class="text-gray-600 mb-6 leading-relaxed">
                    Chúng tôi tập trung vào PHP, Laravel và Fullstack Web với
                    lộ trình rõ ràng, bài giảng dễ hiểu và dự án thực tế.
                </p>

                <ul class="space-y-3 text-gray-700">
                    <li class="flex items-center gap-2">
                        <span class="text-indigo-600">✔</span> Nội dung sát thực tế
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="text-indigo-600">✔</span> Học mọi lúc, mọi nơi
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="text-indigo-600">✔</span> Có tài nguyên & source code
                    </li>
                </ul>
            </div>

            {{-- Image --}}
            <div class="h-72 bg-gray-100 rounded-2xl shadow flex items-center justify-center text-gray-400">
                Illustration / Image
            </div>

        </div>
    </div>
</section>


{{-- ================= CONTACT ================= --}}
<section id="contact" class="bg-gray-50 py-24">
    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold mb-4">
                Liên hệ với chúng tôi
            </h2>
            <p class="text-gray-600">
                Chúng tôi luôn sẵn sàng hỗ trợ bạn
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-12">

            {{-- Info --}}
            <div class="space-y-6 text-gray-700">
                <p>
                    Nếu bạn có câu hỏi về khoá học, lộ trình học
                    hoặc cần hỗ trợ kỹ thuật, hãy liên hệ với chúng tôi.
                </p>

                <p>📧 Email: <strong>support@educourse.vn</strong></p>
                <p>📞 Hotline: <strong>0123 456 789</strong></p>
                <p>📍 Địa chỉ: <strong>TP. Hồ Chí Minh</strong></p>
            </div>

            {{-- Form --}}
            <div class="bg-white p-6 rounded-2xl shadow-sm">
                <form class="space-y-4">
                    <div>
                        <label class="block text-sm mb-1">Họ tên</label>
                        <input
                            class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-indigo-200">
                    </div>

                    <div>
                        <label class="block text-sm mb-1">Email</label>
                        <input
                            class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-indigo-200">
                    </div>

                    <div>
                        <label class="block text-sm mb-1">Nội dung</label>
                        <textarea rows="4"
                                  class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-indigo-200"></textarea>
                    </div>

                    <button
                        type="button"
                        class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">
                        Gửi liên hệ
                    </button>
                </form>
            </div>

        </div>
    </div>
</section>

    {{-- ================= CTA ================= --}}
    @guest
    <section class="bg-indigo-600 text-white py-20">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-4">
                Bắt đầu học ngay hôm nay
            </h2>
            <p class="text-indigo-100 mb-8">
                Đăng ký miễn phí để truy cập các khoá học và tài nguyên
            </p>
            <a href="{{ route('register') }}"
               class="inline-block px-10 py-3 bg-white text-indigo-600 rounded-lg font-semibold hover:bg-indigo-50">
                Đăng ký miễn phí
            </a>
        </div>
    </section>
    @endguest
</x-guest-layout>
