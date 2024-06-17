<?php

use App\Http\Controllers\Admin\AdminAuthenticationController;
use App\Http\Controllers\Admin\AgencyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Fleet\FacilityController;
use App\Http\Controllers\Admin\Fleet\FleetTypeController;
use App\Http\Controllers\Admin\Fleet\SeatLayoutController;
use App\Http\Controllers\Admin\Fleet\VehicleController;
use App\Http\Controllers\Admin\Trip\AssignedVehicleController;
use App\Http\Controllers\Admin\Trip\ScheduleController;
use App\Http\Controllers\Admin\Trip\TripController;
use App\Http\Controllers\Admin\Trip\VehicleRouteController;
use App\Http\Controllers\TicketPriceController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin', 'as' => 'admin.'], function(){
    Route::get('login', [AdminAuthenticationController::class, 'login'])->name('login');
    Route::post('login', [AdminAuthenticationController::class, 'handleLogin'])->name('handle-login');
    Route::post('logout', [AdminAuthenticationController::class, 'logout'])->name('logout');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin']], function(){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Manage Agencies
    Route::put('/agencies/{id}/toggle-status', [AgencyController::class, 'toggleStatus'])->name('agencies.toggleStatus');
    Route::resource('agencies', AgencyController::class);
    // Seat Layout
    Route::resource('seat_layouts', SeatLayoutController::class);
    // Fleet Type
    Route::put('/fleet_type/{id}/toggle-status', [FleetTypeController::class, 'toggleStatus'])->name('fleet_type.toggleStatus');
    Route::resource('fleet_type', FleetTypeController::class);
    // Facilities
    Route::resource('facilities', FacilityController::class);
    // Vehicles
    Route::put('/vehicles/{id}/toggle-status', [VehicleController::class, 'toggleStatus'])->name('vehicles.toggleStatus');
    Route::resource('vehicles', VehicleController::class);
    // Vehicle Routes
    Route::put('/route/{id}/toggle-status', [VehicleRouteController::class, 'toggleStatus'])->name('route.toggleStatus');
    Route::resource('route', VehicleRouteController::class);

    // Schedule
    Route::put('/schedule/{id}/toggle-status', [ScheduleController::class, 'toggleStatus'])->name('schedule.toggleStatus');
    Route::resource('schedule', ScheduleController::class);

    // Ticket Price
    Route::get('/route-data', [TicketPriceController::class, 'getRouteData'])->name('ticket-price.get_route_data');
    Route::resource('ticket-price', TicketPriceController::class);

    // Trips
    Route::put('/trips/{id}/toggle-status', [TripController::class, 'toggleStatus'])->name('trips.toggleStatus');
    Route::resource('trips', TripController::class);

    // Assigned Vehicle
    Route::put('/assigned-vehicles/{id}/toggle-status', [AssignedVehicleController::class, 'toggleStatus'])->name('assigned-vehicles.toggleStatus');
    Route::resource('assigned-vehicles', AssignedVehicleController::class);
});