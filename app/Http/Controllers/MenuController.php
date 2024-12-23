<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Table;
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

    public function available()
    {
        $user = auth()->user();
        $availableMenus = MenuItem::where('is_available', true)->paginate(12);
        $availableTables = Table::where('is_available', true)->get();

        return view('menus.available', compact('user', 'availableMenus', 'availableTables'));
    }

    public function show(MenuItem $menuItem)
    {
        $user = auth()->user();
        return view('menus.show', compact('user', 'menuItem'));
    }

    public function edit(MenuItem $menuItem)
    {
        return view('menu.edit', compact('menuItem'));
    }

    public function update(Request $request, MenuItem $menuItem)
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
            // Supprimer l'ancienne photo si elle existe
            if ($menuItem->photo) {
                Storage::disk('public')->delete($menuItem->photo);
            }
            
            $photoPath = $request->file('photo')->store('menu_photos', 'public');
            $validatedData['photo'] = $photoPath;
        }

        $menuItem->update($validatedData);

        return redirect()->route('menu.index')->with('success', 'Item du menu mis à jour avec succès.');
    }

    public function destroy(MenuItem $menuItem)
    {
        // Supprimer la photo si elle existe
        if ($menuItem->photo) {
            Storage::disk('public')->delete($menuItem->photo);
        }

        $menuItem->delete();

        return redirect()->route('menu.index')->with('success', 'Item du menu supprimé avec succès.');
    }
}