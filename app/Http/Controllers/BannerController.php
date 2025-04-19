<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class BannerController extends Controller
{
    protected function validateBanner(Request $request, $isUpdate = false)
    {
        $imageRule = $isUpdate ? 'nullable' : 'required';
        return $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => $imageRule . '|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'required|integer|min:1',
            'button_text' => 'nullable|string|max:50',
            'button_link' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);
    }

    public function index()
    {
        try {
            $banners = Banner::orderBy('order')->get();
            return view('admin.banners.index', compact('banners'));
        } catch (\Exception $e) {
            Log::error('Error fetching banners: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Không thể tải danh sách banner.');
        }
    }

    public function create()
    {
        try {
            return view('admin.banners.create');
        } catch (\Exception $e) {
            Log::error('Error loading create banner form: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Không thể tải form tạo banner.');
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $this->validateBanner($request);

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('banners', 'public');
                $validated['image'] = $path;
            }

            $validated['is_active'] = $request->has('is_active');
            Banner::create($validated);

            return redirect()->route('admin.banners.index')
                ->with('success', 'Banner đã được tạo thành công.');
        } catch (\Exception $e) {
            Log::error('Error creating banner: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Không thể tạo banner.')
                ->withInput();
        }
    }

    public function edit(Banner $banner)
    {
        try {
            return view('admin.banners.edit', compact('banner'));
        } catch (\Exception $e) {
            Log::error('Error loading edit banner form: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Không thể tải form chỉnh sửa banner.');
        }
    }

    public function update(Request $request, Banner $banner)
    {
        try {
            $validated = $this->validateBanner($request, true);

            if ($request->hasFile('image')) {
                if ($banner->image) {
                    Storage::disk('public')->delete($banner->image);
                }
                $path = $request->file('image')->store('banners', 'public');
                $validated['image'] = $path;
            }

            $validated['is_active'] = $request->has('is_active');
            $banner->update($validated);

            return redirect()->route('admin.banners.index')
                ->with('success', 'Banner đã được cập nhật thành công.');
        } catch (\Exception $e) {
            Log::error('Error updating banner: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Không thể cập nhật banner.')
                ->withInput();
        }
    }

    public function destroy(Banner $banner)
    {
        try {
            if ($banner->image) {
                Storage::disk('public')->delete($banner->image);
            }
            
            $banner->delete();
            return redirect()->route('admin.banners.index')
                ->with('success', 'Banner đã được xóa thành công.');
        } catch (\Exception $e) {
            Log::error('Error deleting banner: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Không thể xóa banner.');
        }
    }

    public function getActiveBanners()
    {
        try {
            return Banner::where('is_active', true)
                ->orderBy('order')
                ->get();
        } catch (\Exception $e) {
            Log::error('Error fetching active banners: ' . $e->getMessage());
            return collect();
        }
    }
}