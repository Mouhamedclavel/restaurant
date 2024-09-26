<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\MenuItem;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $view = 'dashboard.' . $user->role;

        if ($user->role === 'admin') {
            // Comptes pour les clients et les managers
            $customerCount = User::where('role', 'customer')->where('status', 'enable')->count();
            $managerCount = User::where('role', 'manager')->where('status', 'enable')->count();
            $recentCustomers = User::where('role', 'customer')->where('status', 'enable')->latest()->take(5)->get();
            $recentManagers = User::where('role', 'manager')->where('status', 'enable')->latest()->take(5)->get();

            return view($view, compact('user', 'customerCount', 'managerCount', 'recentCustomers', 'recentManagers'));
        } elseif ($user->role === 'customer') {
            // Récupérer le nombre de commandes pour chaque statut
            $orderCounts = Order::where('user_id', $user->id)
                ->selectRaw('status, count(*) as count')
                ->groupBy('status')
                ->pluck('count', 'status')
                ->toArray();

            // Initialisation des compteurs avec des valeurs par défaut
            $pendingOrdersCount = $orderCounts['pending'] ?? 0;
            $processingOrdersCount = $orderCounts['processing'] ?? 0;
            $completedOrdersCount = $orderCounts['completed'] ?? 0;
            $cancelledOrdersCount = $orderCounts['cancelled'] ?? 0;

            // Commandes récentes de l'utilisateur
            $recentOrders = Order::where('user_id', $user->id)
                ->with('menuItem')
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();

            // Menus disponibles
            $availableMenus = MenuItem::where('is_available', true)
                ->take(4)
                ->get();

            return view($view, compact(
                'user',
                'pendingOrdersCount',
                'processingOrdersCount',
                'completedOrdersCount',
                'cancelledOrdersCount',
                'recentOrders',
                'availableMenus'
            ));
        }

        return view($view, compact('user'));
    }
}
