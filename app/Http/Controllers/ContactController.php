<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'pickup_location' => 'required|string|max:255',
                'destination' => 'required|string|max:255',
                'pickup_time' => 'required|date',
                'car_type' => 'required|string|max:50',
            ]);

            // For now, just return success
            return redirect()->back()->with('success', 'Yêu cầu của bạn đã được gửi thành công.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Có lỗi xảy ra khi gửi yêu cầu.');
        }
    }
}