<x-guest-layout>
    <div class="w-full max-w-md mx-auto bg-white rounded-2xl shadow-lg p-8">

        <!-- Title -->
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                Xác thực email
            </h1>
            <p class="text-sm text-gray-500 mt-2 leading-relaxed">
                Cảm ơn bạn đã đăng ký 🎉  
                Trước khi bắt đầu, vui lòng xác thực email bằng cách nhấn vào
                liên kết chúng tôi vừa gửi cho bạn.
            </p>
        </div>

        <!-- Status -->
        @if (session('status') === 'verification-link-sent')
            <div class="mb-4 text-sm text-green-600 bg-green-50 border border-green-200 rounded-lg px-4 py-3">
                Liên kết xác thực mới đã được gửi tới email của bạn.
            </div>
        @endif

        <!-- Actions -->
        <div class="flex flex-col gap-4 mt-6">

            <!-- Resend -->
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <x-primary-button class="w-full justify-center py-3">
                    Gửi lại email xác thực
                </x-primary-button>
            </form>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    type="submit"
                    class="w-full text-center text-sm text-gray-600 hover:text-indigo-600 underline">
                    Đăng xuất
                </button>
            </form>

        </div>

        <!-- Helper -->
        <div class="mt-6 text-center text-xs text-gray-500">
            Không thấy email? Hãy kiểm tra thư mục <strong>Spam</strong>.
        </div>

    </div>
</x-guest-layout>
