<?php

// app/Http/Controllers/ManagerDashboardController.php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Order;
use App\Models\Table;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class ManagerDashboardController extends Controller
{
    public function index()
    {
        $reservationsCount = Reservation::count();
        $ordersCount = Order::count();
        $tablesCount = Table::count();
        $menusCount = MenuItem::count();

        $recentOrders = Order::with('menuItem')->latest()->take(5)->get();
        $availableMenus = MenuItem::where('is_available', true)->get();

        return view('manager.dashboard', compact('reservationsCount', 'ordersCount', 'tablesCount', 'menusCount', 'recentOrders', 'availableMenus'));
    }
}
