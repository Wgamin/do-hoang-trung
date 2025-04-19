<?php

namespace App\Http\Controllers;

use App\Models\ServiceCard;
use App\Models\ServiceType;
use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceCardController extends Controller
{
    public function index()
    {
        $serviceCards = ServiceCard::with(['serviceType', 'phone'])->orderBy('id')->get();
        return view('admin.service-cards.index', compact('serviceCards'));
    }

    public function create()
    {
        // Temporarily use id instead of order for sorting
        $serviceTypes = ServiceType::where('is_active', 1)->orderBy('id', 'asc')->get();

        $phones = Phone::where('is_active', 1)->orderBy('id', 'asc')->get();

        return view('admin.service-cards.create', compact('serviceTypes', 'phones'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_type_id' => 'required|exists:service_types,id',
            'phone_id' => 'required|exists:phones,id',
            'pickup_point' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable',  // Bỏ giới hạn max length để CKEditor hoạt động tốt
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('main_image')) {
            $path = $request->file('main_image')->store('service-cards', 'public');
            $validated['main_image'] = $path;
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['description'] = $request->input('description'); // Sử dụng input() thay vì truy cập trực tiếp

        ServiceCard::create($validated);
        return redirect()->route('admin.service-cards.index')
            ->with('success', 'Thẻ dịch vụ đã được tạo thành công.');
    }

    public function edit(ServiceCard $serviceCard)
    {
        // Sửa lại để sử dụng id thay vì order
        $serviceTypes = ServiceType::where('is_active', 1)->orderBy('id', 'asc')->get();

        $phones = Phone::where('is_active', 1)->orderBy('id', 'asc')->get();

        return view('admin.service-cards.edit', compact('serviceCard', 'serviceTypes', 'phones'));
    }

    public function update(Request $request, ServiceCard $serviceCard)
    {
        $validated = $request->validate([
            'service_type_id' => 'required|exists:service_types,id',
            'phone_id' => 'required|exists:phones,id',
            'pickup_point' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable',  // Bỏ giới hạn max length
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('main_image')) {
            if ($serviceCard->main_image) {
                Storage::disk('public')->delete($serviceCard->main_image);
            }
            $path = $request->file('main_image')->store('service-cards', 'public');
            $validated['main_image'] = $path;
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['description'] = $request->input('description'); // Sử dụng input()

        $serviceCard->update($validated);
        return redirect()->route('admin.service-cards.index')
            ->with('success', 'Thẻ dịch vụ đã được cập nhật thành công.');
    }

    public function destroy(ServiceCard $serviceCard)
    {
        if ($serviceCard->main_image) {
            Storage::disk('public')->delete($serviceCard->main_image);
        }

        $serviceCard->delete();
        return redirect()->route('admin.service-cards.index')
            ->with('success', 'Thẻ dịch vụ đã được xóa thành công.');
    }
}
