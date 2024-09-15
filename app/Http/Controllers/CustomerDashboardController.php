<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\MenuItem;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $orderCounts = Order::where('user_id', $user->id)
            ->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $pendingOrdersCount = $orderCounts['pending'] ?? 0;
        $completedOrdersCount = $orderCounts['completed'] ?? 0;
        $cancelledOrdersCount = $orderCounts['cancelled'] ?? 0;
        
        $recentOrders = Order::where('user_id', $user->id)
                             ->with('menuItem')
                             ->orderBy('created_at', 'desc')
                             ->take(5)
                             ->get();

        $availableMenus = MenuItem::where('is_available', true)
                              ->take(4)
                              ->get();

        return view('dashboard.customer', compact(
            'user',
            'pendingOrdersCount',
            'completedOrdersCount',
            'cancelledOrdersCount',
            'recentOrders',
            'availableMenus'
        ));
    }
}