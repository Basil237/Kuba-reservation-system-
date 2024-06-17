<?php

namespace App\Http\Controllers\Admin\Trip;

use App\Http\Controllers\Controller;
use App\Models\Agency;
use App\Models\FleetType;
use App\Models\Schedule;
use App\Models\Trip;
use App\Models\VehicleRoute;
use Illuminate\Http\Request;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trips = Trip::with(['fleetType', 'route', 'schedule'])->orderBy('id', 'desc')->paginate(getPaginate());

        return view('admin.trips.trips.index', compact('trips'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fleetTypes = FleetType::where('status', 1)->get();
        $routes = VehicleRoute::where('status', 1)->get();
        $schedules = Schedule::where('status', 1)->get();
        $stoppages = Agency::where('status', 1)->get();

        return view('admin.trips.trips.create', compact('fleetTypes', 'routes', 'schedules', 'stoppages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'      => 'required',
            'fleet_type' => 'required|integer|gt:0',
            'route'      => 'required|integer|gt:0',
            'schedule'   => 'required|integer|gt:0',
            'start_from' => 'required|integer|gt:0',
            'end_to'     => 'required|integer|gt:0',
            'day_off'    => 'nullable|array|min:1'
        ]);

        $trip = new Trip();
        $trip->title = $request->title;
        $trip->fleet_type_id = $request->fleet_type;
        $trip->vehicle_route_id = $request->route;
        $trip->schedule_id = $request->schedule;
        $trip->start_from = $request->start_from;
        $trip->end_to = $request->end_to;
        $trip->day_off = $request->day_off ?? [];
        $trip->save();

        toast('Trip created successfully', 'success')->width(350);
        return redirect()->route('admin.trips.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $trip = Trip::find($id);
        $fleetTypes = FleetType::where('status', 1)->get();
        $routes = VehicleRoute::where('status', 1)->get();
        $schedules = Schedule::where('status', 1)->get();
        $stoppages = Agency::where('status', 1)->get();

        return view('admin.trips.trips.edit', compact('trip', 'fleetTypes', 'routes', 'schedules', 'stoppages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title'      => 'required',
            'fleet_type' => 'required|integer|gt:0',
            'route'      => 'required|integer|gt:0',
            'schedule'   => 'required|integer|gt:0',
            'start_from' => 'required|integer|gt:0',
            'end_to'     => 'required|integer|gt:0',
            'day_off'    => 'nullable|array|min:1',
        ]);

        $trip = Trip::find($id);
        $trip->title = $request->title;
        $trip->fleet_type_id = $request->fleet_type;
        $trip->vehicle_route_id = $request->route;
        $trip->schedule_id = $request->schedule;
        $trip->start_from = $request->start_from;
        $trip->end_to = $request->end_to;
        $trip->day_off = $request->day_off ?? [];
        $trip->update();

        toast('Trip updated successfully', 'success')->width(350);
        return redirect()->route('admin.trips.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function toggleStatus(string $id)
    {
        $trip = Trip::findOrFail($id);
        $trip->status = $trip->status ? 0 : 1;
        $trip->save();

        toast('Trip status updated successfully', 'success')->width(350);
        return redirect()->back();
    }
}
