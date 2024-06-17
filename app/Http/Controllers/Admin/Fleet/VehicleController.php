<?php

namespace App\Http\Controllers\Admin\Fleet;

use App\Http\Controllers\Controller;
use App\Models\FleetType;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fleetType = FleetType::where('status', 1)->orderBy('id','desc')->get();
        $vehicles = Vehicle::with('fleetType')->orderBy('id','desc')->paginate();
        return view('admin.fleet.vehicle.index', compact('vehicles', 'fleetType'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fleetType = FleetType::where('status', 1)->orderBy('id','desc')->get();
        return view('admin.fleet.vehicle.create', compact('fleetType'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nick_name'         => 'required|string',
            'fleet_type'        => 'required|numeric',
            'register_no'       => 'required|string|unique:vehicles',
            'engine_no'         => 'required|string|unique:vehicles',
            'model_no'          => 'required|string',
            'chasis_no'         => 'required|string|unique:vehicles',
        ]);

        $vehicle = new Vehicle();
        $vehicle->nick_name = $request->nick_name;
        $vehicle->fleet_type_id = $request->fleet_type;
        $vehicle->register_no = $request->register_no;
        $vehicle->engine_no = $request->engine_no;
        $vehicle->chasis_no = $request->chasis_no;
        $vehicle->model_no = $request->model_no;
        $vehicle->save();

        toast('Vehicle created successfully', 'success')->width('350');
        return redirect()->route('admin.vehicles.index');
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
        $fleetType = FleetType::where('status', 1)->orderBy('id','desc')->get();
        $vehicle = Vehicle::with('fleetType')->findOrFail($id);
        return view('admin.fleet.vehicle.edit', compact('vehicle', 'fleetType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'nick_name'         => 'required|string',
            'fleet_type'        => 'required|numeric',
            'register_no'       => 'required|string|unique:vehicles,register_no,'.$id,
            'engine_no'         => 'required|string|unique:vehicles,engine_no,'.$id,
            'model_no'          => 'required|string',
            'chasis_no'         => 'required|string|unique:vehicles,chasis_no,'.$id,
        ]);

        $vehicle = Vehicle::find($id);
        $vehicle->nick_name = $request->nick_name;
        $vehicle->fleet_type_id = $request->fleet_type;
        $vehicle->register_no = $request->register_no;
        $vehicle->engine_no = $request->engine_no;
        $vehicle->chasis_no = $request->chasis_no;
        $vehicle->model_no = $request->model_no;
        $vehicle->save();

        toast('Vehicle Updated successfully', 'success')->width('350');
        return redirect()->route('admin.vehicles.index');
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
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->status = $vehicle->status ? 0 : 1;
        $vehicle->save();

        toast('Fleet status updated successfully','success')->width(350);
        return redirect()->back();
    }
}
