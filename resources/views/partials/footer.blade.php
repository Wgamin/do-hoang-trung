<footer class="bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="xl:grid xl:grid-cols-3 xl:gap-8">
            <div class="space-y-8 xl:col-span-1">
                <img class="h-10" src="{{ asset('images/logo-white.png') }}" alt="{{ config('app.name') }}">
                <p class="text-gray-400 text-base leading-relaxed">
                    Chúng tôi cung cấp các giải pháp công nghệ hiện đại, giúp doanh nghiệp của bạn phát triển trong kỷ nguyên số.
                </p>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                        <span class="sr-only">Facebook</span>
                        <i class="fab fa-facebook-f text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                        <span class="sr-only">Instagram</span>
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                        <span class="sr-only">Twitter</span>
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                        <span class="sr-only">LinkedIn</span>
                        <i class="fab fa-linkedin-in text-xl"></i>
                    </a>
                </div>
            </div>
            <div class="mt-12 grid grid-cols-2 gap-8 xl:mt-0 xl:col-span-2">
                <div class="md:grid md:grid-cols-2 md:gap-8">
                    <div>
                        <h3 class="text-sm font-semibold text-gray-300 tracking-wider uppercase">Giải pháp</h3>
                        <ul role="list" class="mt-4 space-y-4">
                            <li><a href="#" class="text-base text-gray-400 hover:text-white transition-colors duration-200">Thiết kế website</a></li>
                            <li><a href="#" class="text-base text-gray-400 hover:text-white transition-colors duration-200">Ứng dụng di động</a></li>
                            <li><a href="#" class="text-base text-gray-400 hover:text-white transition-colors duration-200">Digital Marketing</a></li>
                            <li><a href="#" class="text-base text-gray-400 hover:text-white transition-colors duration-200">Tư vấn công nghệ</a></li>
                        </ul>
                    </div>
                    <div class="mt-12 md:mt-0">
                        <h3 class="text-sm font-semibold text-gray-300 tracking-wider uppercase">Công ty</h3>
                        <ul role="list" class="mt-4 space-y-4">
                            <li><a href="#" class="text-base text-gray-400 hover:text-white transition-colors duration-200">Về chúng tôi</a></li>
                            <li><a href="#" class="text-base text-gray-400 hover:text-white transition-colors duration-200">Đội ngũ</a></li>
                            <li><a href="#" class="text-base text-gray-400 hover:text-white transition-colors duration-200">Tuyển dụng</a></li>
                            <li><a href="#" class="text-base text-gray-400 hover:text-white transition-colors duration-200">Liên hệ</a></li>
                        </ul>
                    </div>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-300 tracking-wider uppercase">Liên hệ</h3>
                    <ul role="list" class="mt-4 space-y-4">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt text-gray-400 mt-1 mr-3"></i>
                            <span class="text-gray-400">123 Đường ABC, Quận XYZ, TP. Hồ Chí Minh</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone-alt text-gray-400 mr-3"></i>
                            <span class="text-gray-400">(+84) 123 456 789</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope text-gray-400 mr-3"></i>
                            <span class="text-gray-400">info@example.com</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="mt-12 border-t border-gray-800 pt-8">
            <p class="text-base text-gray-400 text-center">&copy; {{ date('Y') }} {{ config('app.name') }}. Tất cả các quyền được bảo lưu.</p>
        </div>
    </div>
</footer>