<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Website chính thức của dịch vụ vận chuyển">
    <meta name="keywords" content="dịch vụ, vận chuyển, taxi, đặt xe">
    <title>Dịch vụ vận chuyển</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/index/banner.css') }}" rel="stylesheet">
    <link href="{{ asset('css/index/Service-type.css') }}" rel="stylesheet">
    <link href="{{ asset('css/index/from.css') }}" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3b82f6',
                        secondary: '#64748b',
                    },
                    fontFamily: {
                        sans: ['Figtree', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        .banner-overlay {
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.6));
        }
    </style>
</head>

<body class="antialiased bg-gray-50 font-sans">
    @include('partials.navigation')

    <!-- Banner Section -->
    <div class="banner-section">
        <div class="banner-container">
            @if(isset($banners) && count($banners) > 0)
            @foreach($banners as $banner)
            <div class="banner-slide">
                <div class="banner-overlay"></div>
                <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->title }}" class="banner-image">
                <div class="banner-content">
                    <h1 class="banner-title">{{ $banner->title }}</h1>
                    <p class="banner-subtitle">{{ $banner->subtitle }}</p>
                    @if($banner->button_text && $banner->button_link)
                    <a href="{{ $banner->button_link }}" class="banner-button">
                        {{ $banner->button_text }}
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
            @endif

            <div class="banner-controls">
                <button class="banner-control-button prev-btn" aria-label="Previous slide">
                    <i class="fas fa-chevron-left text-lg"></i>
                </button>
                <button class="banner-control-button next-btn" aria-label="Next slide">
                    <i class="fas fa-chevron-right text-lg"></i>
                </button>
            </div>
            <div class="banner-dots flex justify-center gap-2 absolute bottom-4 left-1/2 transform -translate-x-1/2 z-20"></div>
        </div>
    </div>

    <!-- Contact Form Section -->
    <section class="contact-section">
        <div class="container">
            <div class="form-wrapper">
                <div class="form-content">
                    <form action="{{ url('contact/submit') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">Họ và tên</label>
                                <input type="text" id="name" name="name" placeholder="Nhập họ tên của bạn" required>
                            </div>

                            <div class="form-group">
                                <label for="phone">Số điện thoại</label>
                                <input type="tel" id="phone" name="phone" placeholder="Nhập số điện thoại" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pickup_location">Điểm đón</label>
                            <input type="text" id="pickup_location" name="pickup_location" placeholder="Nhập địa chỉ đón" required>
                        </div>

                        <div class="form-group">
                            <label for="destination">Điểm đến</label>
                            <input type="text" id="destination" name="destination" placeholder="Nhập địa chỉ đến" required>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="pickup_time">Thời gian đón</label>
                                <input type="datetime-local" id="pickup_time" name="pickup_time" required>
                            </div>

                            <div class="form-group">
                                <label for="car_type">Loại xe</label>
                                <select id="car_type" name="car_type" required>
                                    <option value="">-- Chọn loại xe --</option>
                                    <option value="4_chỗ">Xe 4 chỗ</option>
                                    <option value="5_chỗ">Xe 5 chỗ</option>
                                    <option value="7_chỗ">Xe 7 chỗ</option>
                                    <option value="16_chỗ">Xe 16 chỗ</option>
                                </select>
                            </div>
                        </div>

                        <div class="phone-links">
                            @if(isset($phones) && count($phones) > 0)
                            @foreach($phones as $phone)
                            @if($phone->is_active)
                            <a href="tel:{{ $phone->phone_number }}" class="phone-link">
                                <i class="fas fa-phone-alt"></i>
                                <span>{{ $phone->phone_number }}</span>
                            </a>
                            @endif
                            @endforeach
                            @endif
                        </div>

                        <button type="submit" class="submit-button">Đặt xe ngay</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Service Types Section -->
    <section class="service-type-section">
        @if(isset($serviceTypes) && count($serviceTypes) > 0)
        @foreach($serviceTypes as $serviceType)
        <div class="name-severvice-type">
            <div class="background-name-severvice-type">
                <p>{{ $serviceType->name }}</p>
            </div>

            <div class="slider-wrapper">
                <button class="slider-btn prev-btn">&#10094;</button>

                <div class="slider-track">
                    @if(isset($serviceType->serviceCards) && count($serviceType->serviceCards) > 0)
                    @foreach($serviceType->serviceCards as $serviceCard)
                    @if($serviceCard->is_active)
                    <div class="service-card">
                        <a href="{{ route('service.show', $serviceCard) }}" class="service-card-link">
                            <div class="service-image-wrapper">
                                <img src="{{ asset('storage/' . $serviceCard->main_image) }}"
                                    alt="{{ $serviceCard->pickup_point }} - {{ $serviceCard->destination }}" />
                                <div class="service-text">
                                    <p>{{ $serviceCard->pickup_point }} - {{ $serviceCard->destination }}</p>
                                    <p>GIÁ: {{ number_format($serviceCard->price, 0, ',', '.') }}K</p>
                                    @if($serviceCard->description)
                                    <p class="service-description">{{ Str::limit($serviceCard->description, 100) }}</p>
                                    @endif
                                </div>
                            </div>
                        </a>
                        <div class="service-actions">
                            <div class="service-phone">
                                @if($serviceCard->phone)
                                <a href="tel:{{ $serviceCard->phone->phone_number }}" class="phone-button">
                                    <i class="fas fa-phone-alt"></i>
                                    <span>{{ $serviceCard->phone->phone_number }}</span>
                                </a>
                                @endif
                            </div>
                            <a href="{{ route('service.show', $serviceCard) }}" class="details-button">
                                <i class="fas fa-info-circle"></i>
                                <span>Chi tiết</span>
                            </a>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    @else
                    <div class="service-card empty">
                        <p>Chưa có dịch vụ nào</p>
                    </div>
                    @endif
                </div>

                <button class="slider-btn next-btn">&#10095;</button>
            </div>
        </div>
        @endforeach
        @endif
    </section>

    @include('partials.footer')

    <!-- Scripts -->
    <script src="{{ asset('js/index/banner.js') }}"></script>
    <script src="{{ asset('js/index/welcome.js') }}"></script>

    <!-- Debug section - Xóa sau khi fix xong -->
    <!-- @if(isset($serviceTypes))
    <div style="display: none;">
        <p>Số lượng loại dịch vụ: {{ $serviceTypes->count() }}</p>
        @foreach($serviceTypes as $type)
            <p>{{ $type->name }}: {{ $type->serviceCards->count() }} dịch vụ</p>
        @endforeach
    </div>
    @endif -->
</body>