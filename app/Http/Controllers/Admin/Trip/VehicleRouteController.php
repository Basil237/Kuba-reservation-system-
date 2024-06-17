<?php

namespace App\Http\Controllers\Admin\Trip;

use App\Http\Controllers\Controller;
use App\Models\Agency;
use App\Models\VehicleRoute;
use Illuminate\Http\Request;

class VehicleRouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $routes = VehicleRoute::with(['startFrom', 'endTo'])->orderBy('id', 'desc')->get();
        $stoppages = Agency::active()->get();
        return view('admin.trips.route.index', compact('routes', 'stoppages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $stoppages = Agency::active()->get();
        return view('admin.trips.route.create', compact('stoppages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'start_from' => 'required|integer|gt:0',
            'end_to' => 'required|integer|gt:0',
            'distance' => 'required',
            'time' => 'required',
            'stoppages' => 'nullable|array|min:1',
            'stoppages.*' => 'nullable|integer|gt:0',
        ], [
            'stoppages.*.integer' => 'Invalid Stoppage Field'
        ]);

        if ($request->start_from == $request->end_to) {
            toast('Starting point and ending point can\'t be same', 'error')->width(350);
            return back();
        }

        $stoppages = $request->stoppages ? array_filter($request->stoppages) : [];

        if (!in_array($request->start_from, $stoppages)) {
            array_unshift($stoppages, $request->start_from);
        }

        if (!in_array($request->end_to, $stoppages)) {
            array_push($stoppages, $request->end_to);
        }

        $route = new VehicleRoute();
        $route->name = $request->name;
        $route->start_from = $request->start_from;
        $route->end_to = $request->end_to;
        $route->stoppages  = array_unique($stoppages);
        $route->distance = $request->distance;
        $route->time = $request->time;
        $route->save();

        toast('Route created successfully', 'success')->width(350);
        return redirect()->route('admin.route.index');
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
        $route = VehicleRoute::findOrFail($id);
        $allStoppages = Agency::active()->get();

        $stoppagesArray = $route->stoppages;
        if (($pos = array_search($route->start_from, $stoppagesArray)) !== false) {
            unset($stoppagesArray[$pos]);
        }
        if (($pos = array_search($route->end_to, $stoppagesArray)) !== false) {
            unset($stoppagesArray[$pos]);
        }

        if (!empty($stoppagesArray)) {
            $stoppages = Agency::active()->whereIn('id', $stoppagesArray)
                ->orderByRaw("field(id," . implode(',', $stoppagesArray) . ")")
                ->get();
        } else {
            $stoppages = [];
        }

        return view('admin.trips.route.edit', compact('stoppages', 'route', 'allStoppages'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'start_from' => 'required|integer|gt:0',
            'end_to' => 'required|integer|gt:0',
            'distance' => 'required',
            'time' => 'required',
            'stoppages' => 'nullable|array|min:1',
            'stoppages.*' => 'nullable|integer|gt:0',
        ], [
            'stoppages.*.integer' => 'Invalid Stoppage Field'
        ]);

        if ($request->start_from == $request->end_to) {
            toast('Starting point and ending point can\'t be same', 'error')->width(350);
            return back();
        }

        $stoppages = $request->stoppages ? array_filter($request->stoppages) : [];

        if (!in_array($request->start_from, $stoppages)) {
            array_unshift($stoppages, $request->start_from);
        }

        if (!in_array($request->end_to, $stoppages)) {
            array_push($stoppages, $request->end_to);
        }

        $route = VehicleRoute::findOrFail($id);
        $route->name = $request->name;
        $route->start_from = $request->start_from;
        $route->end_to = $request->end_to;
        $route->stoppages  = array_unique($stoppages);
        $route->distance = $request->distance;
        $route->time = $request->time;
        $route->save();

        toast('Route updated successfully', 'success')->width(350);
        return redirect()->route('admin.route.index');
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
        $vehicle = VehicleRoute::findOrFail($id);
        $vehicle->status = $vehicle->status ? 0 : 1;
        $vehicle->save();

        toast('Route status updated successfully', 'success')->width(350);
        return redirect()->back();
    }
}
