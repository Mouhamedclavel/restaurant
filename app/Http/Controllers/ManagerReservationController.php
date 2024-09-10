<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ManagerReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['user', 'table'])
                                   ->orderBy('reservation_date', 'desc')
                                   ->orderBy('reservation_time', 'desc')
                                   ->paginate(15);

        return view('manager.reservations.index', compact('reservations'));
    }

    public function updateStatus(Request $request, Reservation $reservation)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled'
        ]);

        $reservation->status = $request->status;
        $reservation->save();

        return redirect()->back()->with('success', 'Statut de la réservation mis à jour avec succès.');
    }
}