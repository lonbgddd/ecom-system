<x-guest-layout>
    <div class="w-full max-w-md mx-auto bg-white rounded-2xl shadow-lg p-8">

        {{-- Logo / Title --}}
        <div class="text-center mb-8">
            <a href="{{ route('home') }}"
               class="text-2xl font-bold text-indigo-600">
                EduCourse
            </a>
            <p class="text-sm text-gray-500 mt-2">
                Đăng nhập để tiếp tục học tập
            </p>
        </div>

        {{-- Session status --}}
        <x-auth-session-status class="mb-4 text-sm text-green-600"
                               :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
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
                    autocomplete="username"
                    placeholder="you@example.com"
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            {{-- Password --}}
            <div>
                <x-input-label for="password" value="Mật khẩu" />
                <x-text-input
                    id="password"
                    type="password"
                    name="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="current-password"
                    placeholder="••••••••"
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            {{-- Remember --}}
            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center text-sm text-gray-600">
                    <input id="remember_me"
                           type="checkbox"
                           name="remember"
                           class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <span class="ml-2">Ghi nhớ đăng nhập</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="text-sm text-indigo-600 hover:underline">
                        Quên mật khẩu?
                    </a>
                @endif
            </div>

            {{-- Submit --}}
            <button
                type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2.5 rounded-lg font-medium transition">
                Đăng nhập
            </button>
        </form>

        {{-- Divider --}}
        <div class="my-6 flex items-center">
            <div class="flex-1 h-px bg-gray-200"></div>
            <span class="px-4 text-xs text-gray-400">HOẶC</span>
            <div class="flex-1 h-px bg-gray-200"></div>
        </div>

        {{-- Register --}}
        <p class="text-center text-sm text-gray-600">
            Chưa có tài khoản?
            <a href="{{ route('register') }}"
               class="text-indigo-600 font-medium hover:underline">
                Đăng ký ngay
            </a>
        </p>
    </div>
</x-guest-layout>
