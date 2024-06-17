<?php

namespace App\Http\Controllers\Admin\Fleet;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\FleetType;
use App\Models\SeatLayout;
use Illuminate\Http\Request;

class FleetTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fleetType = FleetType::orderBy('id', 'desc')->paginate();
        return view('admin.fleet.fleet_type.index', compact('fleetType'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $seatLayouts = SeatLayout::all();
        $fleetType = FleetType::orderBy('id','desc')->paginate();
        $facilities = Facility::all();
        return view('admin.fleet.fleet_type.create', compact('fleetType' ,'seatLayouts', 'facilities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|unique:fleet_types',
            'seat_layout' => 'required',
            'deck'        => 'required|numeric|gt:0',
            'deck_seats'  => 'required|array|min:1',
            'deck_seats.*'=> 'required|numeric|gt:0',
            'facilities.*'=> 'string'
        ],[
            'deck_seats.*.required'  => 'Seat number for all deck is required',
            'deck_seats.*.numeric'   => 'Seat number for all deck is must be a number',
            'deck_seats.*.gt:0'      => 'Seat number for all deck is must be greater than 0',
        ]);

        $fleetType = new FleetType();
        $fleetType->name = $request->name;
        $fleetType->seat_layout = $request->seat_layout;
        $fleetType->deck = $request->deck;
        $fleetType->deck_seats = $request->deck_seats;
        $fleetType->has_ac = $request->has_ac ? $request->has_ac : 0;
        $fleetType->facilities = $request->facilities ?? null;
        $fleetType->status = 1;
        $fleetType->save();

        toast('Fleet Type Created successfully', 'success')->width('350');
        return redirect()->route('admin.fleet_type.index');
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
        $fleetType = FleetType::findOrFail($id);
        $seatLayouts = SeatLayout::all();
        $facilities = Facility::all();
        return view('admin.fleet.fleet_type.edit', compact('fleetType' ,'seatLayouts', 'facilities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'        => 'required|unique:fleet_types,name,'.$id,
            'seat_layout' => 'required',
            'deck'        => 'required|numeric|gt:0',
            'deck_seats'  => 'required|array|min:1',
            'deck_seats.*'=> 'required|numeric|gt:0',
            'facilities.*'=> 'string'
        ],[
            'deck_seats.*.required'  => 'Seat number for all deck is required',
            'deck_seats.*.numeric'   => 'Seat number for all deck is must be a number',
            'deck_seats.*.gt:0'      => 'Seat number for all deck is must be greater than 0',
        ]);

        $fleetType = FleetType::find($id);
        $fleetType->name = $request->name;
        $fleetType->seat_layout = $request->seat_layout;
        $fleetType->deck = $request->deck;
        $fleetType->deck_seats = $request->deck_seats;
        $fleetType->has_ac = $request->has_ac ? 1 : 0;
        $fleetType->facilities = $request->facilities ?? null;
        $fleetType->save();

        toast('Fleet Type Updated successfully', 'success')->width('350');
        return redirect()->route('admin.fleet_type.index');
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
        $fleetType = FleetType::findOrFail($id);
        $fleetType->status = $fleetType->status ? 0 : 1;
        $fleetType->save();

        toast('Fleet status updated successfully','success')->width(350);
        return redirect()->back();
    }
}
