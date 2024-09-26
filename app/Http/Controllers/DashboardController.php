<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\MenuItem;
use App\Models\Reservation;
use App\Models\Table;

class DashboardController extends Controller
{
  public function index()
    {
        $user = auth()->user();
        $viewName = 'dashboard.' . $user->role;

        $data = [
            'user' => $user,
        ];

        switch ($user->role) {
            case 'admin':
                $data += $this->getAdminData();
                break;
            case 'manager':
                $data += $this->getManagerData();
                break;
            case 'customer':
                $data += $this->getCustomerData($user->id);
                break;
        }

        return view($viewName, $data);
    }

    private function getAdminData()
    {
        return [
            'customerCount' => User::where('role', 'customer')->where('status', 'enable')->count(),
            'managerCount' => User::where('role', 'manager')->where('status', 'enable')->count(),
            'recentCustomers' => User::where('role', 'customer')->where('status', 'enable')->latest()->take(5)->get(),
            'recentManagers' => User::where('role', 'manager')->where('status', 'enable')->latest()->take(5)->get(),
            'reservationsCount' => Reservation::count(),
        ];
    }

    private function getManagerData()
    {
        return [
            'reservationsCount' => Reservation::count(),
            'ordersCount' => Order::count(),
            'tablesCount' => Table::count(),
            'menusCount' => MenuItem::count(),
            'recentOrders' => Order::with('menuItem')->latest()->take(2)->get(), // Changed from 5 to 2
            'availableMenus' => MenuItem::where('is_available', true)->take(2)->get(), 
        ];
    }

    private function getCustomerData($userId)
    {
        $orderCounts = Order::where('user_id', $userId)
            ->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        return [
            'pendingOrdersCount' => $orderCounts['pending'] ?? 0,
            'processingOrdersCount' => $orderCounts['processing'] ?? 0,
            'completedOrdersCount' => $orderCounts['completed'] ?? 0,
            'cancelledOrdersCount' => $orderCounts['cancelled'] ?? 0,
            'recentOrders' => Order::where('user_id', $userId)->with('menuItem')->latest()->take(5)->get(),
            'availableMenus' => MenuItem::where('is_available', true)->take(4)->get(),
        ];
    }

    

    public function manageManagers()
    {
        $user = auth()->user();
        $managers = User::where('role', 'manager')->get();
        return view('dashboard.manage_managers', compact('user', 'managers'));
    }

    public function manageCustomers()
    {
        $user = auth()->user();
        $customers = User::where('role', 'customer')->get();
        return view('dashboard.manage_customers', compact('user', 'customers'));
    }

    public function toggleUserStatus(User $user)
    {
        $user->status = $user->status === 'enable' ? 'disable' : 'enable';
        $user->save();

        $message = $user->status === 'enable' ? 'débloqué' : 'bloqué';
        return back()->with('success', "L'utilisateur a été $message avec succès.");
    }

    public function manageOrders()
    {
        $user = auth()->user();
        $orders = Order::with('menuItem')->get();
        return view('dashboard.manage_orders', compact('user', 'orders'));
    }

    public function manageMenus()
    {
        $user = auth()->user();
        $menus = MenuItem::all();
        return view('dashboard.manage_menus', compact('user', 'menus'));
    }
}
