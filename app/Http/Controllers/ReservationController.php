<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'table_id' => 'required|exists:tables,id',
            'reservation_date' => 'required|date',
            'reservation_time' => 'required',
            'number_of_guests' => 'required|integer|min:1',
        ]);

        $table = Table::findOrFail($validatedData['table_id']);

        if ($validatedData['number_of_guests'] > $table->capacity) {
            return redirect()->back()->with('error', 'Le nombre de personnes dépasse la capacité de la table.');
        }

        $reservation = new Reservation();
        $reservation->user_id = auth()->id();
        $reservation->table_id = $validatedData['table_id'];
        $reservation->reservation_date = $validatedData['reservation_date'];
        $reservation->reservation_time = $validatedData['reservation_time'];
        $reservation->number_of_guests = $validatedData['number_of_guests'];
        $reservation->save();

        return redirect()->back()->with('success', 'Réservation effectuée avec succès!');
    }
}