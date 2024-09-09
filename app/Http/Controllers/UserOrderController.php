<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class UserOrderController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $orders = Order::where('user_id', $user->id)
                       ->orderBy('created_at', 'desc')
                       ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function cancel(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            return redirect()->route('user.orders')->with('error', 'Vous n\'êtes pas autorisé à annuler cette commande.');
        }

        if ($order->status !== 'pending') {
            return redirect()->route('user.orders')->with('error', 'Seules les commandes en attente peuvent être annulées.');
        }

        $order->status = 'cancelled';
        $order->save();

        return redirect()->route('user.orders')->with('success', 'La commande a été annulée avec succès.');
    }
}