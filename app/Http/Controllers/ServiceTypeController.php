<?php

namespace App\Http\Controllers;

use App\Models\ServiceType;
use Illuminate\Http\Request;

class ServiceTypeController extends Controller
{
    public function index()
    {
        // Temporarily use id instead of order for sorting
        $serviceTypes = ServiceType::orderBy('id', 'asc')->get();
        return view('admin.service-types.index', compact('serviceTypes'));
    }

    public function create()
    {
        return view('admin.service-types.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = ServiceType::max('order') + 1; // Tự động tăng order
        $validated['created_at'] = now();

        ServiceType::create($validated);
        return redirect()->route('admin.service-types.index')
            ->with('success', 'Loại dịch vụ đã được tạo thành công.');
    }


    public function edit(ServiceType $serviceType)
    {
        return view('admin.service-types.edit', compact('serviceType'));
    }

    public function update(Request $request, ServiceType $serviceType)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'required|integer|min:1',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $serviceType->update($validated);
        return redirect()->route('admin.service-types.index')
            ->with('success', 'Loại dịch vụ đã được cập nhật thành công.');
    }

    public function destroy(ServiceType $serviceType)
    {
        $serviceType->delete();
        return redirect()->route('admin.service-types.index')
            ->with('success', 'Loại dịch vụ đã được xóa thành công.');
    }
}
