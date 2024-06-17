<?php

use App\Http\Controllers\AgencyController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::get('/search-bus', [BusController::class, 'searchBus'])->name('search-bus');
Route::get('ticket/search', [BusController::class, 'ticketSearch'])->name('search');

Route::get('/trips', [BusController::class, 'trip'])->name('trip');
Route::get('/trips/{id}/{slug}', [BusController::class, 'showSeat'])->name('trip.seats');
Route::get('/trips/get-price', [BusController::class, 'getTicketPrice'])->name('trip.get-price');
Route::get('/trips/book/{id}', [BusController::class, 'bookTicket'])->name('trip.book');
Route::get('/agengies', [AgencyController::class, 'index'])->name('agencies');
Route::get('/dashboard', function () {
    return view('users.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
