<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'menu_item_id' => 'required|exists:menu_items,id',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
        ]);

        $order = new Order();
        $order->user_id = auth()->id();
        $order->menu_item_id = $validatedData['menu_item_id'];
        $order->price = $validatedData['price'];
        $order->quantity = $validatedData['quantity'];
        $order->save();

        return redirect()->back()->with('success', 'Commande passée avec succès!');
    }
}