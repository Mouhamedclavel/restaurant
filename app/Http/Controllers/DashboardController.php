<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $view = 'dashboard.' . $user->role;
        return view($view, compact('user'));
    }
}