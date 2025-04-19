<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\ServiceType;
use App\Models\Phone;
use App\Models\ServiceCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    protected $bannerController;

    public function __construct(BannerController $bannerController)
    {
        $this->bannerController = $bannerController;
    }

    public function index()
    {
        try {
            // Debug để kiểm tra dữ liệu
            Log::info('Bắt đầu tải dữ liệu trang chủ');

            $banners = $this->bannerController->getActiveBanners();
            Log::info('Số lượng banners: ' . $banners->count());

            // Lấy tất cả dịch vụ và sắp xếp theo id
            $serviceCards = ServiceCard::with(['serviceType', 'phone'])
                ->where('is_active', true)
                ->orderBy('id')
                ->get();
            Log::info('Số lượng service cards: ' . $serviceCards->count());

            // Lấy tất cả loại dịch vụ đang hoạt động
            $serviceTypes = ServiceType::where('is_active', true)
                ->orderBy('id')
                ->get();
            Log::info('Số lượng service types: ' . $serviceTypes->count());

            // Gán dịch vụ cho từng loại
            foreach ($serviceTypes as $type) {
                $type->serviceCards = $serviceCards->where('service_type_id', $type->id);
            }

            // Lọc bỏ các loại không có dịch vụ
            $serviceTypes = $serviceTypes->filter(function ($type) {
                return $type->serviceCards->isNotEmpty();
            });

            $phones = Phone::where('is_active', true)
                ->orderBy('id')
                ->get();
            Log::info('Số lượng phones: ' . $phones->count());

            return view('welcome', compact('banners', 'serviceTypes', 'phones'));
        } catch (\Exception $e) {
            Log::error('Lỗi trang chủ: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            return view('welcome')->with('error', 'Đã có lỗi xảy ra khi tải trang.');
        }
    }

    public function showService(ServiceCard $serviceCard)
    {
        try {
            if (!$serviceCard->is_active) {
                return redirect()->route('home')
                    ->with('error', 'Dịch vụ này hiện không khả dụng.');
            }

            $serviceCard->load(['serviceType', 'phone']);

            // Lấy các dịch vụ liên quan
            $relatedServices = ServiceCard::with(['serviceType', 'phone'])
                ->where('service_type_id', $serviceCard->service_type_id)
                ->where('id', '!=', $serviceCard->id)
                ->where('is_active', true)
                ->limit(3)
                ->get();

            return view('services.show', compact('serviceCard', 'relatedServices'));
        } catch (\Exception $e) {
            Log::error('Service detail error: ' . $e->getMessage());
            return redirect()->route('home')
                ->with('error', 'Không thể hiển thị chi tiết dịch vụ.');
        }
    }
}
