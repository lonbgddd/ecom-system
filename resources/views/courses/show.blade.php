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
                class="fixed inset-0 z-50 hidden flex-col bg-black">

                <div class="flex justify-between items-center p-4 text-white bg-black">
                    <h3 id="lessonTitle"></h3>
                    <button onclick="closeLesson()">✕</button>
                </div>

                <div id="lessonContent" class="flex-1"></div>

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
                    onclick='openLesson(
"{{ $lesson->title }}",
"{{ $lesson->type === "video" 
    ? route("video.stream", $lesson->id)
    : ($lesson->type === "pdf" 
        ? route("pdf.view", $lesson->id)
        : (Str::startsWith($lesson->file_path, ["http://","https://"]) 
            ? $lesson->file_path 
            : asset("storage/".$lesson->file_path))) }}",
"{{ $lesson->type }}"
)'
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

            // 🎬 VIDEO FILE
            if (type === 'video') {
                html = `
<video controls autoplay class="w-screen h-screen object-contain bg-black">
    <source src="${file}" type="video/mp4">
</video>`
            }

            // 📺 YOUTUBE
            if (type === 'youtube') {

    let videoId = ''

    // dạng watch?v=
    if (file.includes('watch?v=')) {
        videoId = file.split('v=')[1].split('&')[0]
    }

    // dạng youtu.be/
    else if (file.includes('youtu.be/')) {
        videoId = file.split('youtu.be/')[1].split('?')[0]
    }

    const embedUrl = `https://www.youtube.com/embed/${videoId}`

    html = `
<iframe 
    src="${embedUrl}" 
    class="w-screen h-screen"
    frameborder="0"
    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
    allowfullscreen>
</iframe>`
}

            // 📄 PDF
            if (type === 'pdf') {
                html = `<iframe src="${file}" class="w-screen h-screen"></iframe>`
            }

            // 🖼 IMAGE
            if (type === 'image') {
                html = `<img src="${file}" class="w-screen h-screen object-contain bg-black">`
            }

            document.getElementById('lessonContent').innerHTML = html
        }

  function closeLesson() {
    document.body.style.overflow = 'auto'

    const modal = document.getElementById('lessonModal')
    modal.classList.add('hidden')

    // 🔥 QUAN TRỌNG: xoá player
    const content = document.getElementById('lessonContent')
    content.innerHTML = ''
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