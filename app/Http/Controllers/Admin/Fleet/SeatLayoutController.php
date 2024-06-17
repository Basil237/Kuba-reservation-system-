<?php

namespace App\Http\Controllers\Admin\Fleet;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminSeatLayoutUpdateRequest;
use App\Models\SeatLayout;
use Illuminate\Http\Request;

class SeatLayoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $layouts = SeatLayout::orderBy('id', 'desc')->get();
        return view('admin.fleet.seat_layout.index', compact('layouts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.fleet.seat_layout.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'layout' => 'required|unique:seat_layouts'
        ]);

        $seatLayout = new SeatLayout();
        $seatLayout->layout = $request->layout;
        $seatLayout->save();

        toast('Seat Layout created successfully', 'success')->width('350');
        return redirect()->route('admin.seat_layouts.index');
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
        $layout = SeatLayout::findOrFail($id);
        return view('admin.fleet.seat_layout.edit', compact('layout'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminSeatLayoutUpdateRequest $request, string $id)
    {
        $seatLayout = SeatLayout::findOrFail($id);
        $seatLayout->layout = $request->layout;
        $seatLayout->save();

        toast('Seat Layout Updated successfully', 'success')->width('350');
        return redirect()->route('admin.seat_layouts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $layout = SeatLayout::findOrFail($id);
        $layout->delete();
        return  redirect()->route('admin.seat_layouts.index');
    }
}
