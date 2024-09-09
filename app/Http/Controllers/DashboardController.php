<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $view = 'dashboard.' . $user->role;

        if ($user->role === 'admin') {
            $customerCount = User::where('role', 'customer')->where('status', 'enable')->count();
            $managerCount = User::where('role', 'manager')->where('status', 'enable')->count();
            $recentCustomers = User::where('role', 'customer')->where('status', 'enable')->latest()->take(5)->get();
            $recentManagers = User::where('role', 'manager')->where('status', 'enable')->latest()->take(5)->get();

            return view($view, compact('user', 'customerCount', 'managerCount', 'recentCustomers', 'recentManagers'));
        }

        return view($view, compact('user'));
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
}