<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            {{-- LEFT --}}
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="text-xl font-bold text-indigo-600">
                    EduCourse
                </a>

                {{-- Desktop Menu --}}
                <div class="hidden sm:flex sm:ms-10 space-x-8">

                    {{-- ===== GUEST ===== --}}
                    @guest
                        <x-nav-link href="#courses">Khoá học</x-nav-link>
                        <x-nav-link href="#about">Giới thiệu</x-nav-link>
                        <x-nav-link href="#contact">Liên hệ</x-nav-link>
                    @endguest

                    {{-- ===== USER ===== --}}
                    @auth
                        <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                            Trang chủ
                        </x-nav-link>

                        <x-nav-link :href="route('user.courses')" :active="request()->routeIs('user.courses')">
                            Khoá học của tôi
                        </x-nav-link>
                    @endauth

                </div>
            </div>

            {{-- RIGHT --}}
            <div class="hidden sm:flex sm:items-center space-x-4">

                {{-- GUEST --}}
                @guest
                    <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-indigo-600">
                        Đăng nhập
                    </a>
                    <a href="{{ route('register') }}"
                       class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm">
                        Đăng ký
                    </a>
                @endguest

                {{-- USER --}}
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 text-sm">
                                {{ Auth::user()->name }}
                                ⌄
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                Hồ sơ
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Đăng xuất
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth
            </div>

            {{-- HAMBURGER --}}
            <div class="flex items-center sm:hidden">
                <button @click="open = !open">☰</button>
            </div>
        </div>
    </div>

    {{-- MOBILE --}}
    <div x-show="open" class="sm:hidden px-4 pb-4 space-y-2">

        @guest
            <a href="#courses" class="block">Khoá học</a>
            <a href="#about" class="block">Giới thiệu</a>
            <a href="#contact" class="block">Liên hệ</a>
            <a href="{{ route('login') }}" class="block">Đăng nhập</a>
        @endguest

        @auth
            <a href="{{ route('user.courses') }}" class="block">Khoá học của tôi</a>
            <a href="{{ route('profile.edit') }}" class="block">Hồ sơ</a>
        @endauth
    </div>
</nav>
