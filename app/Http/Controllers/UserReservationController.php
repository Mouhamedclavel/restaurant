<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class UserReservationController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $reservations = Reservation::where('user_id', $user->id)
                                   ->orderBy('reservation_date', 'desc')
                                   ->orderBy('reservation_time', 'desc')
                                   ->paginate(10);

        return view('reservations.index', compact('reservations'));
    }

    public function cancel(Reservation $reservation)
    {
        if ($reservation->user_id !== auth()->id()) {
            return redirect()->route('user.reservations')->with('error', 'Vous n\'êtes pas autorisé à annuler cette réservation.');
        }

        if ($reservation->status !== 'pending') {
            return redirect()->route('user.reservations')->with('error', 'Seules les réservations en attente peuvent être annulées.');
        }

        $reservation->status = 'cancelled';
        $reservation->save();

        return redirect()->route('user.reservations')->with('success', 'La réservation a été annulée avec succès.');
    }
}