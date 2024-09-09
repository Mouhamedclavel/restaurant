<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::get('/admin-only', function () {
    // Contenu réservé aux administrateurs
})->middleware('role:admin');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/manage-managers', [DashboardController::class, 'manageManagers'])->name('manage.managers');
    Route::get('/manage-customers', [DashboardController::class, 'manageCustomers'])->name('manage.customers');
});

Route::post('/toggle-user-status/{user}', [DashboardController::class, 'toggleUserStatus'])->name('toggle.user.status');

Route::resource('menu', MenuController::class)->middleware(['auth', 'role:admin,manager']);

// Routes pour le menu
Route::middleware(['auth', 'role:admin,manager'])->group(function () {
    Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
    Route::get('/menu/create', [MenuController::class, 'create'])->name('menu.create');
    Route::post('/menu', [MenuController::class, 'store'])->name('menu.store');
    Route::get('/menu/{menuItem}/edit', [MenuController::class, 'edit'])->name('menu.edit');
    Route::put('/menu/{menuItem}', [MenuController::class, 'update'])->name('menu.update');
    Route::delete('/menu/{menuItem}', [MenuController::class, 'destroy'])->name('menu.destroy');
});

Route::middleware(['auth', 'role:admin,manager'])->group(function () {
    Route::resource('tables', TableController::class);
});

Route::get('/tables/{table}/edit', [TableController::class, 'edit']);

Route::get('/menus', [MenuController::class, 'available'])->name('menus.available');
Route::get('/menus/{menuItem}', [MenuController::class, 'show'])->name('menus.show');

Route::post('/orders', [OrderController::class, 'store'])->name('orders.store')->middleware('auth');
