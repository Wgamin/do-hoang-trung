<nav class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="/">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-9">
                    </a>
                </div>
            </div>

            <!-- Navigation Links -->
            <div class="flex items-center">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2">Admin</a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2">Đăng nhập</a>
                    <a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2">Đăng ký</a>
                @endauth
            </div>
        </div>
    </div>
</nav>