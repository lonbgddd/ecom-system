<x-guest-layout>
    <div class="w-full max-w-md mx-auto bg-white rounded-2xl shadow-lg p-8">

        {{-- Logo / Title --}}
        <div class="text-center mb-8">
            <a href="{{ route('home') }}"
               class="text-2xl font-bold text-indigo-600">
                EduCourse
            </a>
            <p class="text-sm text-gray-500 mt-2">
                Tạo tài khoản để bắt đầu học tập
            </p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            {{-- Name --}}
            <div>
                <x-input-label for="name" value="Họ và tên" />
                <x-text-input
                    id="name"
                    type="text"
                    name="name"
                    class="mt-1 block w-full"
                    :value="old('name')"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Nguyễn Văn A"
                />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

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
                    autocomplete="new-password"
                    placeholder="••••••••"
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            {{-- Confirm Password --}}
            <div>
                <x-input-label for="password_confirmation" value="Nhập lại mật khẩu" />
                <x-text-input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                    placeholder="••••••••"
                />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            {{-- Submit --}}
            <button
                type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2.5 rounded-lg font-medium transition">
                Đăng ký
            </button>
        </form>

        {{-- Divider --}}
        <div class="my-6 flex items-center">
            <div class="flex-1 h-px bg-gray-200"></div>
            <span class="px-4 text-xs text-gray-400">HOẶC</span>
            <div class="flex-1 h-px bg-gray-200"></div>
        </div>

        {{-- Login link --}}
        <p class="text-center text-sm text-gray-600">
            Đã có tài khoản?
            <a href="{{ route('login') }}"
               class="text-indigo-600 font-medium hover:underline">
                Đăng nhập
            </a>
        </p>
    </div>
</x-guest-layout>
