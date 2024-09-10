<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class ManagerOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'menuItem'])
                       ->orderBy('created_at', 'desc')
                       ->paginate(15);

        return view('manager.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Statut de la commande mis à jour avec succès.');
    }
}