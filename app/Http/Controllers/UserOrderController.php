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
}