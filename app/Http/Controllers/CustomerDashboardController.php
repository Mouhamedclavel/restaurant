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
        $recentOrders = Order::where('user_id', $user->id)
                             ->orderBy('created_at', 'desc')
                             ->take(5)
                             ->get();

        $availableMenus = MenuItem::where('is_available', true)
                              ->take(4)
                              ->get();

        $pendingOrdersCount = Order::where('user_id', $user->id)->where('status', 'pending')->count();
        $completedOrdersCount = Order::where('user_id', $user->id)->where('status', 'completed')->count();
        $cancelledOrdersCount = Order::where('user_id', $user->id)->where('status', 'cancelled')->count();

        return view('dashboard.customer', compact(
            'user',
            'recentOrders',
            'availableMenus',
            'pendingOrdersCount',
            'completedOrdersCount',
            'cancelledOrdersCount'
        ));
    }
}