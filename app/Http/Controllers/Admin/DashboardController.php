<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_products' => Product::count(),
            'active_products' => Product::where('is_active', true)->count(),
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'total_revenue' => Order::where('payment_status', 'paid')->sum('total'),
            'total_users' => User::where('is_admin', false)->count(),
            'total_categories' => Category::count(),
            'total_posts' => Post::count(),
        ];

        $recentOrders = Order::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $topProducts = Product::orderBy('sales_count', 'desc')
            ->limit(5)
            ->get();

        $monthlyRevenue = Order::where('payment_status', 'paid')
            ->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(total) as revenue')
            )
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->get();

        return view('admin.dashboard', compact('stats', 'recentOrders', 'topProducts', 'monthlyRevenue'));
    }
}
