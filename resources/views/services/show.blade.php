@extends('layouts.service')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Cột chính -->
        <div class="md:col-span-2">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="{{ asset('storage/' . $serviceCard->main_image) }}" 
                     alt="{{ $serviceCard->pickup_point }} - {{ $serviceCard->destination }}"
                     class="w-full h-96 object-cover">
                
                <div class="p-6">
                    <h1 class="text-3xl font-bold mb-4">
                        {{ $serviceCard->pickup_point }} - {{ $serviceCard->destination }}
                    </h1>
                    
                    <div class="mb-6">
                        <p class="text-xl font-semibold text-blue-600">
                            Giá: {{ number_format($serviceCard->price, 0, ',', '.') }}K
                        </p>
                    </div>

                    @if($serviceCard->description)
                    <div class="prose max-w-none mb-6">
                        {!! $serviceCard->description !!}
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Cột thông tin bên phải -->
        <div class="md:col-span-1">
            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <h2 class="text-xl font-bold mb-4">Thông tin liên hệ</h2>
                @if($serviceCard->phone)
                <div class="mb-4">
                    <a href="tel:{{ $serviceCard->phone->phone_number }}" 
                       class="flex items-center justify-center w-full px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700">
                        <i class="fas fa-phone-alt mr-2"></i>
                        {{ $serviceCard->phone->phone_number }}
                    </a>
                </div>
                @endif
                
                <div class="border-t pt-4">
                    <h3 class="font-semibold mb-2">Chi tiết dịch vụ:</h3>
                    <ul class="space-y-2">
                        <li><strong>Loại dịch vụ:</strong> {{ $serviceCard->serviceType->name }}</li>
                        <li><strong>Điểm đón:</strong> {{ $serviceCard->pickup_point }}</li>
                        <li><strong>Điểm đến:</strong> {{ $serviceCard->destination }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection