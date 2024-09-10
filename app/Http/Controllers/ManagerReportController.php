<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ManagerReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : Carbon::now()->startOfMonth();
        $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : Carbon::now()->endOfMonth();

        $dailyOrders = Order::whereBetween('created_at', [$startDate, $endDate])
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'), DB::raw('SUM(price * quantity) as total'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $monthlyOrders = Order::whereBetween('created_at', [$startDate, $endDate])
            ->select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'), DB::raw('SUM(price * quantity) as total'))
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $dailyReservations = Reservation::whereBetween('reservation_date', [$startDate, $endDate])
            ->select('reservation_date as date', DB::raw('COUNT(*) as count'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $monthlyReservations = Reservation::whereBetween('reservation_date', [$startDate, $endDate])
            ->select(DB::raw('YEAR(reservation_date) as year'), DB::raw('MONTH(reservation_date) as month'), DB::raw('COUNT(*) as count'))
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        return view('manager.reports.index', compact('dailyOrders', 'monthlyOrders', 'dailyReservations', 'monthlyReservations', 'startDate', 'endDate'));
    }
}