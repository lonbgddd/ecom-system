<x-guest-layout>
    <div class="w-full max-w-md mx-auto bg-white rounded-2xl shadow-lg p-8">

        {{-- Logo / Title --}}
        <div class="text-center mb-6">
            <a href="{{ route('home') }}"
               class="text-2xl font-bold text-indigo-600">
                EduCourse
            </a>

            <h1 class="mt-3 text-lg font-semibold text-gray-800">
                Quên mật khẩu?
            </h1>

            <p class="mt-2 text-sm text-gray-500">
                Nhập email đã đăng ký, chúng tôi sẽ gửi link để bạn đặt lại mật khẩu.
            </p>
        </div>

        {{-- Session status --}}
        <x-auth-session-status
            class="mb-4 text-sm text-green-600 text-center"
            :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
            @csrf

            {{-- Email --}}
            <div>
                <x-input-label for="email" value="Email" />
                <x-text-input
                    id="email"
                    type="email"
                    name="email"
                    class="mt-1 block w-full"
                    :value="old('email')"
                    required
                    autofocus
                    placeholder="you@example.com"
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            {{-- Submit --}}
            <button
                type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2.5 rounded-lg font-medium transition">
                Gửi link đặt lại mật khẩu
            </button>
        </form>

        {{-- Back to login --}}
        <p class="mt-6 text-center text-sm text-gray-600">
            Nhớ mật khẩu rồi?
            <a href="{{ route('login') }}"
               class="text-indigo-600 font-medium hover:underline">
                Quay về đăng nhập
            </a>
        </p>
    </div>
</x-guest-layout>
