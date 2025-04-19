<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    public function index()
    {
        // Sắp xếp theo id tương tự như các controller khác
        $phones = Phone::orderBy('id', 'asc')->get();
        return view('admin.phones.index', compact('phones'));
    }

    public function create()
    {
        return view('admin.phones.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'phone_number' => 'required|string|max:20|unique:phones',
            'name' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        // Đảm bảo is_active được xử lý đúng cách
        $validated['is_active'] = $request->has('is_active');
        
        Phone::create($validated);
        return redirect()->route('admin.phones.index')
            ->with('success', 'Số điện thoại đã được thêm thành công.');
    }

    public function edit(Phone $phone)
    {
        return view('admin.phones.edit', compact('phone'));
    }

    public function update(Request $request, Phone $phone)
    {
        $validated = $request->validate([
            'phone_number' => 'required|string|max:20|unique:phones,phone_number,' . $phone->id,
            'name' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $phone->update($validated);
        return redirect()->route('admin.phones.index')
            ->with('success', 'Số điện thoại đã được cập nhật thành công.');
    }

    public function destroy(Phone $phone)
    {
        // Kiểm tra xem có ServiceCard nào đang sử dụng phone này không
        if ($phone->serviceCards()->count() > 0) {
            return redirect()->route('admin.phones.index')
                ->with('error', 'Không thể xóa số điện thoại này vì đang được sử dụng trong các dịch vụ.');
        }
        
        $phone->delete();
        return redirect()->route('admin.phones.index')
            ->with('success', 'Số điện thoại đã được xóa thành công.');
    }
}
