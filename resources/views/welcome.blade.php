<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>EduCourse – Nền tảng học lập trình</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html { scroll-behavior: smooth; }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

<!-- ================= HEADER ================= -->
<header id="mainHeader"
        class="bg-white sticky top-0 z-50 transition-all shadow">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

        <!-- Logo -->
        <a href="/" class="text-2xl font-bold text-indigo-600">
            EduCourse
        </a>

        <!-- Navigation -->
        <nav class="hidden md:flex items-center space-x-6">
            <a href="#courses" data-section="courses"
               class="nav-link hover:text-indigo-600">
                Khoá học
            </a>
            <a href="#about" data-section="about"
               class="nav-link hover:text-indigo-600">
                Giới thiệu
            </a>
            <a href="#contact" data-section="contact"
               class="nav-link hover:text-indigo-600">
                Liên hệ
            </a>
        </nav>

        <!-- Auth -->
        <div class="flex items-center space-x-4">
            @auth
                <a href="{{ route('dashboard') }}"
                   class="px-4 py-2 border rounded-lg hover:bg-gray-100">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="hover:underline">
                    Đăng nhập
                </a>
                <a href="{{ route('register') }}"
                   class="px-4 py-2 bg-indigo-600 text-white rounded-lg">
                    Đăng ký
                </a>
            @endauth
        </div>
    </div>
</header>

<!-- ================= HERO ================= -->
<section class="bg-indigo-50 py-24">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">
            Học lập trình online<br class="hidden md:block">
            từ cơ bản đến nâng cao
        </h1>

        <p class="text-gray-600 max-w-2xl mx-auto mb-10">
            EduCourse cung cấp các khoá học PHP, Laravel và Fullstack Web
            với nội dung thực tế, dễ hiểu và ứng dụng cao.
        </p>

        <a href="#courses"
           class="inline-block px-8 py-3 bg-indigo-600 text-white rounded-lg text-lg">
            Khám phá khoá học
        </a>
    </div>
</section>

<!-- ================= COURSES ================= -->
<section id="courses" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-3xl font-bold text-center mb-14">
            Khoá học nổi bật
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ($courses as $course)
                <div class="border rounded-xl overflow-hidden hover:shadow-lg transition">
                    <div class="h-40 bg-gray-200 flex items-center justify-center text-gray-500">
                        Thumbnail
                    </div>

                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-2">
                            {{ $course['title'] }}
                        </h3>

                        <p class="text-sm text-gray-600 mb-4">
                            {{ $course['desc'] }}
                        </p>

                        <div class="flex justify-between items-center">
                            <span class="font-bold text-indigo-600">
                                {{ $course['price'] }}
                            </span>

                            <a href="{{ route('login') }}"
                               class="text-sm underline hover:text-indigo-600">
                                Xem chi tiết →
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ================= ABOUT ================= -->
<section id="about" class="py-24 bg-gray-100">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid md:grid-cols-2 gap-12 items-center">

            <div>
                <h2 class="text-3xl font-bold mb-6">
                    Về nền tảng EduCourse
                </h2>

                <p class="text-gray-600 mb-4 leading-relaxed">
                    EduCourse là nền tảng học lập trình trực tuyến giúp sinh viên
                    và người mới tiếp cận công nghệ web một cách bài bản.
                </p>

                <p class="text-gray-600 mb-6 leading-relaxed">
                    Các khoá học tập trung vào PHP, Laravel và Fullstack,
                    được xây dựng theo lộ trình từ cơ bản đến nâng cao.
                </p>

                <ul class="space-y-3 text-gray-700">
                    <li>✔ Nội dung thực tế</li>
                    <li>✔ Học mọi lúc, mọi nơi</li>
                    <li>✔ Có tài nguyên đi kèm</li>
                </ul>
            </div>

            <div class="h-72 bg-white rounded-xl shadow flex items-center justify-center text-gray-400">
                Illustration / Image
            </div>
        </div>
    </div>
</section>

<!-- ================= CONTACT ================= -->
<section id="contact" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-3xl font-bold text-center mb-14">
            Liên hệ với chúng tôi
        </h2>

        <div class="grid md:grid-cols-2 gap-12">
            <div class="space-y-6 text-gray-700">
                <p>
                    Nếu bạn có câu hỏi về khoá học hoặc cần hỗ trợ,
                    vui lòng liên hệ với chúng tôi.
                </p>

                <p>📧 Email: <strong>support@educourse.vn</strong></p>
                <p>📞 Hotline: <strong>0123 456 789</strong></p>
                <p>📍 Địa chỉ: <strong>TP. Hồ Chí Minh</strong></p>
            </div>

            <div class="bg-gray-50 p-6 rounded-xl shadow-sm">
                <form>
                    <div class="mb-4">
                        <label class="block text-sm mb-1">Họ tên</label>
                        <input class="w-full border rounded-lg px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm mb-1">Email</label>
                        <input class="w-full border rounded-lg px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm mb-1">Nội dung</label>
                        <textarea rows="4"
                                  class="w-full border rounded-lg px-3 py-2"></textarea>
                    </div>

                    <button type="button"
                            class="w-full bg-indigo-600 text-white py-2 rounded-lg">
                        Gửi liên hệ
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- ================= FOOTER ================= -->
<footer class="bg-gray-100 py-8 text-center text-sm text-gray-500">
    © {{ date('Y') }} EduCourse Platform. All rights reserved.
</footer>

<!-- ================= SCROLL SPY SCRIPT ================= -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-link');

    function onScroll() {
        let scrollPos = window.scrollY + 120;

        sections.forEach(section => {
            const top = section.offsetTop;
            const height = section.offsetHeight;
            const id = section.getAttribute('id');

            if (scrollPos >= top && scrollPos < top + height) {
                navLinks.forEach(link => {
                    link.classList.remove('text-indigo-600', 'font-semibold');
                    if (link.dataset.section === id) {
                        link.classList.add('text-indigo-600', 'font-semibold');
                    }
                });
            }
        });
    }

    window.addEventListener('scroll', onScroll);
});
</script>

</body>
</html>
