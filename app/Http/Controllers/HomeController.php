<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\FleetType;
use App\Models\Schedule;
use App\Models\Trip;
use App\Models\VehicleRoute;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $agency = Agency::active()->get();
        $fleetType = FleetType::active()->get();

        $trips = Trip::with(['fleetType', 'route', 'schedule', 'startFrom', 'endTo', 'agency'])->where('status', 1)->paginate(getPaginate(10));

        if (auth()->user()) {
            $layout = 'layouts.master';
        } else {
            $layout = 'layouts.frontend';
        }

        $schedules = Schedule::all();
        $routes = VehicleRoute::active()->get();
        return view('pages.home', compact('fleetType', 'trips', 'routes', 'schedules', 'agency'));
    }
}
