<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        $menuItems = MenuItem::all();
        return view('menu.index', compact('menuItems'));
    }

    public function create()
    {
        return view('menu.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'category' => 'required|in:entrée,plat,dessert,boisson',
            'is_available' => 'boolean',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $validatedData['is_available'] = $request->has('is_available');

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('menu_photos', 'public');
            $validatedData['photo'] = $photoPath;
        }

        MenuItem::create($validatedData);

        return redirect()->route('menu.index')->with('success', 'Item ajouté au menu avec succès.');
    }





  
}