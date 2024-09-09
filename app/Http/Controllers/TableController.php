<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index()
    {
        $tables = Table::all();
        return view('tables.index', compact('tables'));
    }

    public function create()
    {
        $locations = Table::LOCATIONS;
        return view('tables.create', compact('locations'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'number' => 'required|integer|unique:tables',
            'location' => 'required|in:' . implode(',', array_keys(Table::LOCATIONS)),
            'capacity' => 'required|integer|min:1',
            'is_available' => 'boolean',
        ]);

        Table::create($validatedData);

        return redirect()->route('tables.index')->with('success', 'Table ajoutée avec succès.');
    }

    public function edit(Table $table)
    {
        $locations = Table::LOCATIONS;
        return view('tables.edit', compact('table', 'locations'));
    }

    public function update(Request $request, Table $table)
    {
        $validatedData = $request->validate([
            'number' => 'required|integer|unique:tables,number,' . $table->id,
            'location' => 'required|in:' . implode(',', array_keys(Table::LOCATIONS)),
            'capacity' => 'required|integer|min:1',
            'is_available' => 'boolean',
        ]);

        $table->update($validatedData);

        return redirect()->route('tables.index')->with('success', 'Table mise à jour avec succès.');
    }

    public function destroy(Table $table)
    {
        $table->delete();
        return redirect()->route('tables.index')->with('success', 'Table supprimée avec succès.');
    }
}