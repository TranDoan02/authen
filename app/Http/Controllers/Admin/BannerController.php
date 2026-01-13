<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('position')->orderBy('display_order')->get();
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        \Log::info('Banner store called', $request->all());

        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'image_path' => 'required|image|max:5120', // Max 5MB
            'link_url' => 'nullable|string|max:255',
            'position' => 'required|string',
            'display_order' => 'integer|min:0',
        ]);

        if ($request->hasFile('image_path')) {
            $path = $request->file('image_path')->store('banners', 'public');
            $validated['image_path'] = $path;
            \Log::info('Image uploaded to: ' . $path);
        }

        $validated['is_active'] = $request->has('is_active');

        \Log::info('Validated data for creation:', $validated);

        try {
            $banner = Banner::create($validated);
            \Log::info('Banner created successfully:', $banner->toArray());
        } catch (\Exception $e) {
            \Log::error('Error creating banner: ' . $e->getMessage());
            return back()->with('error', 'Lỗi khi lưu banner: ' . $e->getMessage())->withInput();
        }

        return redirect()->route('admin.banners.index')->with('success', 'Banner đã được tạo thành công');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'image_path' => 'nullable|image|max:5120',
            'link_url' => 'nullable|string|max:255',
            'position' => 'required|string',
            'display_order' => 'integer|min:0',
        ]);

        if ($request->hasFile('image_path')) {
            if ($banner->image_path) {
                Storage::disk('public')->delete($banner->image_path);
            }
            $validated['image_path'] = $request->file('image_path')->store('banners', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        $banner->update($validated);

        return redirect()->route('admin.banners.index')->with('success', 'Banner đã được cập nhật');
    }

    public function destroy(Banner $banner)
    {
        if ($banner->image_path) {
            Storage::disk('public')->delete($banner->image_path);
        }
        $banner->delete();

        return redirect()->route('admin.banners.index')->with('success', 'Banner đã được xóa');
    }
}
