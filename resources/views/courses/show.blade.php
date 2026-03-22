<x-guest-layout>
    <x-slot:title>
        {{ $course->title }} | EduCourse
    </x-slot:title>

    {{-- ================= COURSE HERO ================= --}}
    <section class="bg-gradient-to-br from-indigo-600 to-purple-600 text-white">
        <div class="max-w-7xl mx-auto px-6 py-20 grid md:grid-cols-2 gap-12 items-center">

            <div>
                <h1 class="text-4xl font-bold mb-4 leading-tight">
                    {{ $course->title }}
                </h1>

                <p class="text-indigo-100 mb-6">
                    {{ $course->description }}
                </p>

                <div class="flex items-center gap-6 mb-8">
                    <span class="text-2xl font-bold">
                        {{ $course->price == 0 ? 'Miễn phí' : number_format($course->price).'₫' }}
                    </span>

                    <span class="px-3 py-1 rounded-full text-sm bg-white/20">
                        {{ $course->price == 0 ? 'Free Course' : 'Paid Course' }}
                    </span>
                </div>

                <a href="#lessons"
                    class="inline-flex items-center gap-2 px-8 py-3 bg-white text-indigo-600 rounded-lg font-semibold hover:bg-indigo-50 transition">
                    Bắt đầu học →
                </a>
            </div>

            <div class="rounded-2xl overflow-hidden shadow-lg h-72 bg-white/10">
                @if($course->thumbnail)
                <img src="{{ asset('storage/'.$course->thumbnail) }}"
                    class="w-full h-full object-cover">
                @else
                <div class="h-full flex items-center justify-center text-white/60">
                    Thumbnail
                </div>
                @endif
            </div>

        </div>
    </section>

    {{-- ================= COURSE INFO ================= --}}
    <section class="bg-white py-24">
        <div class="max-w-5xl mx-auto px-6">

            {{-- Overview --}}
            <div class="mb-16">
                <h2 class="text-2xl font-bold mb-4">
                    Giới thiệu khoá học
                </h2>

                <p class="text-gray-700 leading-relaxed">
                    {{ $course->content ?? 'Nội dung giới thiệu đang được cập nhật.' }}
                </p>
            </div>

            {{-- ================= LESSON MODAL ================= --}}
            <div id="lessonModal"
                class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 p-4">

                <div class="bg-white rounded-xl w-full max-w-4xl max-h-[85vh] flex flex-col overflow-hidden">

                    <div class="flex items-center justify-between border-b p-4">
                        <h3 id="lessonTitle" class="text-xl font-bold"></h3>

                        <button onclick="closeLesson()"
                            class="text-gray-500 hover:text-black text-xl">
                            ✕
                        </button>
                    </div>

                    <div id="lessonContent"
                        class="overflow-y-auto p-6 flex-1"></div>

                </div>
            </div>

            {{-- ================= PAYMENT MODAL ================= --}}
            <div id="buyModal"
                class="fixed inset-0 z-50 hidden bg-white overflow-y-auto">

                <div class="max-w-7xl mx-auto px-6 py-10">

                    {{-- HEADER --}}
                    <div class="flex items-center justify-between mb-10">

                        <h2 class="text-2xl font-bold">
                            Thanh toán khóa học
                        </h2>

                        <button onclick="closeBuyModal()"
                            class="text-gray-500 text-2xl">
                            ✕
                        </button>

                    </div>

                    <div class="grid md:grid-cols-3 gap-10">

                        {{-- LEFT: PAYMENT FORM --}}
                        <div class="md:col-span-2 space-y-8">

                            {{-- Customer info --}}
                            <div class="border rounded-xl p-6">

                                <h3 class="font-semibold mb-4 text-lg">
                                    Thông tin người học
                                </h3>

                                <div class="grid md:grid-cols-2 gap-4">

                                    <input
                                        class="border rounded-lg p-3"
                                        placeholder="Họ và tên" />

                                    <input
                                        class="border rounded-lg p-3"
                                        placeholder="Email" />

                                    <input
                                        class="border rounded-lg p-3"
                                        placeholder="Số điện thoại" />

                                    <input
                                        class="border rounded-lg p-3"
                                        placeholder="Địa chỉ" />

                                </div>

                            </div>

                            {{-- Payment method --}}
                            <div class="border rounded-xl p-6">

                                <h3 class="font-semibold mb-4 text-lg">
                                    Chọn phương thức thanh toán
                                </h3>

                                <div class="space-y-4">

                                    <label class="flex items-center gap-3 border p-4 rounded-lg cursor-pointer">

                                        <input type="radio" name="payment" checked>

                                        <div>
                                            <p class="font-medium">
                                                Chuyển khoản ngân hàng
                                            </p>

                                            <p class="text-sm text-gray-500">
                                                Internet Banking / Mobile Banking
                                            </p>
                                        </div>

                                    </label>

                                    <label class="flex items-center gap-3 border p-4 rounded-lg cursor-pointer">

                                        <input type="radio" name="payment">

                                        <div>
                                            <p class="font-medium">
                                                Ví điện tử
                                            </p>

                                            <p class="text-sm text-gray-500">
                                                Momo / ZaloPay
                                            </p>
                                        </div>

                                    </label>

                                    <label class="flex items-center gap-3 border p-4 rounded-lg cursor-pointer">

                                        <input type="radio" name="payment">

                                        <div>
                                            <p class="font-medium">
                                                QR Banking
                                            </p>

                                            <p class="text-sm text-gray-500">
                                                Quét QR để thanh toán
                                            </p>
                                        </div>

                                    </label>

                                </div>

                            </div>

                            {{-- Bank list --}}
                            <div class="border rounded-xl p-6">

                                <h3 class="font-semibold mb-4 text-lg">
                                    Chọn ngân hàng
                                </h3>

                                <div class="grid grid-cols-4 gap-4">

                                    <div class="border p-3 rounded text-center cursor-pointer hover:bg-gray-50">
                                        VCB
                                    </div>

                                    <div class="border p-3 rounded text-center cursor-pointer hover:bg-gray-50">
                                        ACB
                                    </div>

                                    <div class="border p-3 rounded text-center cursor-pointer hover:bg-gray-50">
                                        Tech
                                    </div>

                                    <div class="border p-3 rounded text-center cursor-pointer hover:bg-gray-50">
                                        MB
                                    </div>

                                    <div class="border p-3 rounded text-center cursor-pointer hover:bg-gray-50">
                                        BIDV
                                    </div>

                                    <div class="border p-3 rounded text-center cursor-pointer hover:bg-gray-50">
                                        TPBank
                                    </div>

                                    <div class="border p-3 rounded text-center cursor-pointer hover:bg-gray-50">
                                        VPBank
                                    </div>

                                    <div class="border p-3 rounded text-center cursor-pointer hover:bg-gray-50">
                                        Vietin
                                    </div>

                                </div>

                            </div>

                        </div>

                        {{-- RIGHT: ORDER SUMMARY --}}
                        <div class="border rounded-xl p-6 h-fit">

                            <h3 class="font-semibold text-lg mb-4">
                                Thông tin đơn hàng
                            </h3>

                            <div class="flex gap-4 mb-6">

                                @if($course->thumbnail)
                                <img
                                    src="{{ asset('storage/'.$course->thumbnail) }}"
                                    class="w-24 h-16 object-cover rounded">
                                @endif

                                <div>

                                    <p class="font-medium">
                                        {{ $course->title }}
                                    </p>

                                    <p class="text-sm text-gray-500">
                                        Khóa học online
                                    </p>

                                </div>

                            </div>

                            <div class="space-y-2 text-sm">

                                <div class="flex justify-between">
                                    <span>Giá khóa học</span>
                                    <span>{{ number_format($course->price) }}₫</span>
                                </div>

                                <div class="flex justify-between">
                                    <span>Giảm giá</span>
                                    <span>0₫</span>
                                </div>

                                <hr>

                                <div class="flex justify-between text-lg font-bold">
                                    <span>Tổng thanh toán</span>
                                    <span>{{ number_format($course->price) }}₫</span>
                                </div>

                            </div>

                            <form method="POST" action="{{ route('courses.buy',$course->id) }}" class="mt-6">

                                @csrf

                                <input type="hidden" name="payment_method" id="payment_method">

                                <button
                                    class="w-full bg-indigo-600 text-white py-3 rounded-lg font-semibold hover:bg-indigo-700">

                                    Xác nhận thanh toán

                                </button>

                            </form>

                            <p class="text-xs text-gray-500 mt-4 text-center">
                                Sau khi thanh toán admin sẽ duyệt để kích hoạt khóa học.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            {{-- ================= LESSON LIST ================= --}}
            <div id="lessons" class="border rounded-xl divide-y">

                @foreach($course->resources as $lesson)

                <div
                    class="flex items-center justify-between p-4 hover:bg-gray-50 cursor-pointer"

                    @if($lesson->is_preview || $hasAccess)
                    onclick="openLesson(
                    '{{ $lesson->title }}',
                    '{{ asset('storage/'.$lesson->file_path) }}',
                    '{{ $lesson->type }}'
                    )"
                    @else
                    onclick="openBuyModal()"
                    @endif
                    >

                    <div>
                        <p class="font-medium">
                            {{ $lesson->title }}
                        </p>

                        @if(!$lesson->is_preview && !$hasAccess)
                        <span class="text-xs text-red-500">🔒 Bị khóa</span>
                        @endif
                    </div>

                    <span class="text-indigo-600">
                        @if($lesson->is_preview || $hasAccess)
                        Xem →
                        @else
                        Mua →
                        @endif
                    </span>

                </div>

                @endforeach

            </div>

        </div>
    </section>

    {{-- ================= SCRIPT ================= --}}
    <script>
        function openLesson(title, file, type) {

            document.body.style.overflow = 'hidden'

            const modal = document.getElementById('lessonModal')
            modal.classList.remove('hidden')

            document.getElementById('lessonTitle').innerText = title

            let html = ''

            if (type === 'video') {
                html = `
<video controls class="w-full rounded-lg">
<source src="${file}" type="video/mp4">
</video>`
            }

            if (type === 'pdf') {
                html = `<iframe src="${file}" class="w-full h-[500px]"></iframe>`
            }

            if (type === 'image') {
                html = `<img src="${file}" class="w-full rounded-lg">`
            }

            if (type === 'code') {
                fetch(file)
                    .then(r => r.text())
                    .then(data => {
                        document.getElementById('lessonContent').innerHTML =
                            `<pre class="bg-gray-900 text-white p-4 rounded overflow-x-auto">${data}</pre>`
                    })
                return
            }

            document.getElementById('lessonContent').innerHTML = html
        }

        function closeLesson() {
            document.body.style.overflow = 'auto'
            document.getElementById('lessonModal').classList.add('hidden')
        }

        function openBuyModal() {
            document.body.style.overflow = 'hidden'
            document.getElementById('buyModal').classList.remove('hidden')
        }

        function closeBuyModal() {
            document.body.style.overflow = 'auto'
            document.getElementById('buyModal').classList.add('hidden')
        }
    </script>

</x-guest-layout>