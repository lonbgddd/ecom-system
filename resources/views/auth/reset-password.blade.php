<x-guest-layout>
    <div class="w-full max-w-md mx-auto bg-white rounded-2xl shadow-lg p-8">

        <!-- Title -->
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                Đặt lại mật khẩu
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Nhập mật khẩu mới cho tài khoản của bạn
            </p>
        </div>

        <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
            @csrf

            <!-- Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email -->
            <div>
                <x-input-label for="email" value="Email" />
                <x-text-input
                    id="email"
                    class="block mt-1 w-full"
                    type="email"
                    name="email"
                    :value="old('email', $request->email)"
                    required
                    autofocus
                    autocomplete="username"
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" value="Mật khẩu mới" />
                <x-text-input
                    id="password"
                    class="block mt-1 w-full"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" value="Xác nhận mật khẩu" />
                <x-text-input
                    id="password_confirmation"
                    class="block mt-1 w-full"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Submit -->
            <div class="pt-4">
                <x-primary-button class="w-full justify-center py-3 text-base">
                    Đặt lại mật khẩu
                </x-primary-button>
            </div>
        </form>

        <!-- Back to login -->
        <div class="mt-6 text-center text-sm">
            <a href="{{ route('login') }}"
               class="text-indigo-600 hover:underline">
                ← Quay lại đăng nhập
            </a>
        </div>

    </div>
</x-guest-layout>
