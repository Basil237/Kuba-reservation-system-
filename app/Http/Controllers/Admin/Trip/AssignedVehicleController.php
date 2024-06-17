<?php

namespace App\Http\Controllers\Admin\Trip;

use App\Http\Controllers\Controller;
use App\Models\AssignedVehicle;
use App\Models\Trip;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AssignedVehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trips = Trip::with('fleetType.activeVehicles')->where('status', 1)->get();
        $assignedVehicles = AssignedVehicle::with(['trip', 'vehicle'])->orderBy('id', 'desc')->paginate(getPaginate());

        return view('admin.trips.assigned_vehicles.index', compact('trips', 'assignedVehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $trips = Trip::with('fleetType.activeVehicles')->where('status', 1)->get();
        $vehicles = Vehicle::with('fleetType.activeVehicles')->where('status', 1)->get();

        return view('admin.trips.assigned_vehicles.create', compact('trips', 'vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'trip'      => 'required|integer|gt:0',
            'vehicle' => 'required|integer|gt:0'
        ]);

        //Check if the trip has already a assigned vehicle;
        $trip_check = AssignedVehicle::where('trip_id', $request->trip)->first();

        if ($trip_check) {
            toast('A vehicle had already been assinged to this trip', 'error')->width(350);
            return redirect()->back();
        }

        $trip = Trip::where('id', $request->trip)->with('schedule')->firstOrFail();

        $start_time = Carbon::parse($trip->schedule->start_from)->format('H:i:s');
        $end_time   = Carbon::parse($trip->schedule->end_at)->format('H:i:s');

        //Check if the vehicle assgined to another vehicle on this time
        $vehicle_check = AssignedVehicle::where(function ($q) use ($start_time, $end_time, $request) {
            $q->where('start_from', '>=', $start_time)
                ->where('start_from', '<=', $end_time)
                ->where('vehicle_id', $request->vehicle);
        })
            ->orWhere(function ($q) use ($start_time, $end_time, $request) {
                $q->where('end_at', '>=', $start_time)
                    ->where('end_at', '<=', $end_time)
                    ->where('vehicle_id', $request->vehicle);
            })
            ->first();


        if ($vehicle_check) {
            toast('This vehicle had already been assinged to another trip on this time', 'error')->width(350);
            return redirect()->back();
        }

        $assignedVehicle = new AssignedVehicle();
        $assignedVehicle->trip_id = $request->trip;
        $assignedVehicle->vehicle_id = $request->vehicle;
        $assignedVehicle->start_from = $trip->schedule->start_from;
        $assignedVehicle->end_at = $trip->schedule->end_at;
        $assignedVehicle->save();

        toast('Vehicle assigned successfully.', 'success')->width(350);
        return redirect()->route('admin.assigned-vehicles.index');
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
        $assignedVehicle = AssignedVehicle::find($id);
        $trips = Trip::with('fleetType.activeVehicles')->where('status', 1)->get();
        $vehicles = Vehicle::with('fleetType.activeVehicles')->where('status', 1)->get();

        return view('admin.trips.assigned_vehicles.edit', compact('assignedVehicle', 'trips', 'vehicles'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'trip'      => 'required|integer|gt:0',
            'vehicle' => 'required|integer|gt:0'
        ]);

        //Check if the trip has already a assigned vehicle;
        $trip_check = AssignedVehicle::where('trip_id', $request->trip)->where('id', '!=', $id)->first();

        if($trip_check){
            toast('A vehicle had already been assinged to this trip', 'error')->width(350);
            return redirect()->back();
        }

        $trip = Trip::where('id', $request->trip)->with('schedule')->firstOrFail();

        $start_time = Carbon::parse($trip->schedule->start_from)->format('H:i:s');
        $end_time   = Carbon::parse($trip->schedule->end_at)->format('H:i:s');

        //Check if the vehicle assgined to another vehicle on this time
        $vehicle_check = AssignedVehicle::where(function($q) use($start_time,$end_time,$id,$request){
                        $q->where('start_from','>=',$start_time)
                            ->where('start_from','<=',$end_time)
                            ->where('id', '!=', $id)
                            ->where('vehicle_id', $request->vehicle);
                        })
                    ->orWhere(function($q) use($start_time,$end_time,$id,$request){
                            $q->where('end_at','>=',$start_time)
                            ->where('end_at','<=',$end_time)
                            ->where('id', '!=', $id)
                            ->where('vehicle_id', $request->vehicle);
                        })
                    ->first();


        if($vehicle_check){
            toast('This vehicle had already been assinged to another trip on this time', 'error')->width(350);
            return redirect()->back();
        }

        $assignedVehicle = AssignedVehicle::find($id);
        $assignedVehicle->trip_id = $request->trip;
        $assignedVehicle->vehicle_id = $request->vehicle;
        $assignedVehicle->start_from = $trip->schedule->start_from;
        $assignedVehicle->end_at = $trip->schedule->end_at;
        $assignedVehicle->save();
        toast('Vehicle assigned updated successfully.', 'success')->width(350);
        return redirect()->route('admin.assigned-vehicles.index');
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
        $assignedVehicle = AssignedVehicle::findOrFail($id);
        $assignedVehicle->status = $assignedVehicle->status ? 0 : 1;
        $assignedVehicle->save();

        toast('Assigned Vehicle status updated successfully','success')->width(350);
        return redirect()->back();
    }
}
