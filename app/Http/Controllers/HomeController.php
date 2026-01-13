<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\FlashSale;
use App\Models\Post;
use App\Models\Banner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('is_featured', true)
            ->where('is_active', true)
            ->with('images')
            ->orderBy('sales_count', 'desc')
            ->limit(8)
            ->get();

        $flashSale = FlashSale::where('is_active', true)
            ->where('start_time', '<=', now())
            ->where('end_time', '>=', now())
            ->with([
                'products' => function ($query) {
                    $query->with('product.images');
                }
            ])
            ->first();

        $categories = Category::where('is_active', true)
            ->whereNull('parent_id')
            ->with('children')
            ->orderBy('sort_order')
            ->get();

        // Get products by main categories
        $healthCategory = Category::where('slug', 'san-pham-suc-khoe')
            ->orWhere('name', 'like', '%Sức khỏe%')
            ->whereNull('parent_id')
            ->first();
        $beautyCategory = Category::where('slug', 'san-pham-lam-dep')
            ->orWhere('name', 'like', '%Làm đẹp%')
            ->whereNull('parent_id')
            ->first();
        $weightCategory = Category::where('slug', 'san-pham-can-nang')
            ->orWhere('name', 'like', '%Cân nặng%')
            ->whereNull('parent_id')
            ->first();
        $hormoneCategory = Category::where('slug', 'san-pham-noi-tiet')
            ->orWhere('name', 'like', '%Nội tiết%')
            ->whereNull('parent_id')
            ->first();

        $healthProducts = $healthCategory
            ? Product::where('category_id', $healthCategory->id)
                ->orWhereIn('category_id', $healthCategory->children->pluck('id'))
                ->where('is_active', true)
                ->with('images')
                ->orderBy('sales_count', 'desc')
                ->limit(6)
                ->get()
            : collect();

        $beautyProducts = $beautyCategory
            ? Product::where('category_id', $beautyCategory->id)
                ->orWhereIn('category_id', $beautyCategory->children->pluck('id'))
                ->where('is_active', true)
                ->with('images')
                ->orderBy('sales_count', 'desc')
                ->limit(6)
                ->get()
            : collect();

        $weightProducts = $weightCategory
            ? Product::where('category_id', $weightCategory->id)
                ->orWhereIn('category_id', $weightCategory->children->pluck('id'))
                ->where('is_active', true)
                ->with('images')
                ->orderBy('sales_count', 'desc')
                ->limit(6)
                ->get()
            : collect();

        $hormoneProducts = $hormoneCategory
            ? Product::where('category_id', $hormoneCategory->id)
                ->orWhereIn('category_id', $hormoneCategory->children->pluck('id'))
                ->where('is_active', true)
                ->with('images')
                ->orderBy('sales_count', 'desc')
                ->limit(6)
                ->get()
            : collect();

        $latestPosts = Post::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->limit(4)
            ->get();

        $heroBanners = Banner::where('position', 'hero_slider')
            ->where('is_active', true)
            ->orderBy('display_order')
            ->get();

        $section1Banners = Banner::where('position', 'banner_section_1')
            ->where('is_active', true)
            ->orderBy('display_order')
            ->limit(3)
            ->get();

        $section2Banners = Banner::where('position', 'banner_section_2')
            ->where('is_active', true)
            ->orderBy('display_order')
            ->limit(2)
            ->get();

        return view('home', compact(
            'featuredProducts',
            'flashSale',
            'categories',
            'latestPosts',
            'healthProducts',
            'beautyProducts',
            'weightProducts',
            'hormoneProducts',
            'healthCategory',
            'beautyCategory',
            'weightCategory',
            'hormoneCategory',
            'heroBanners',
            'section1Banners',
            'section2Banners'
        ));
    }
}
