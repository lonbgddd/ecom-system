<x-guest-layout>
    <div class="w-full max-w-md mx-auto bg-white rounded-2xl shadow-lg p-8">

        {{-- Logo / Title --}}
        <div class="text-center mb-6">
            <a href="{{ route('home') }}"
               class="text-2xl font-bold text-indigo-600">
                EduCourse
            </a>

            <h1 class="mt-3 text-lg font-semibold text-gray-800">
                Xác nhận mật khẩu
            </h1>

            <p class="mt-2 text-sm text-gray-500">
                Vì lý do bảo mật, vui lòng nhập lại mật khẩu để tiếp tục.
            </p>
        </div>

        <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
            @csrf

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
                    placeholder="Nhập mật khẩu của bạn"
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            {{-- Submit --}}
            <button
                type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2.5 rounded-lg font-medium transition">
                Xác nhận & tiếp tục
            </button>
        </form>
    </div>
</x-guest-layout>
