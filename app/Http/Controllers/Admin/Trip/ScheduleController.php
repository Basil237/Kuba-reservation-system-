<?php

namespace App\Http\Controllers\Admin\Trip;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = Schedule::orderBy('id', 'desc')->get();
        return view('admin.trips.schedule.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.trips.schedule.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'start_from'   => 'required|date_format:H:i',
            'end_at'       => 'required|date_format:H:i',
        ]);

        $check = Schedule::where('start_from', Carbon::parse($request->start_from)->format('H:i:s'))->where('end_at', Carbon::parse($request->end_at)->format('H:i:s'))->first();
        if($check){
            toast('This schedule has already added','error')->width(350);
            return redirect()->back();
        }

        Schedule::create([
            'start_from' => $request->start_from,
            'end_at'     => $request->end_at
        ]);

        toast('Schedule created successfully','success')->width(350);
        return redirect()->route('admin.schedule.index');
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
        $schedule = Schedule::findOrFail($id);
        return view('admin.trips.schedule.edit', compact('schedule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'start_from'   => 'required|date_format:H:i',
            'end_at'       => 'required|date_format:H:i',
        ]);

        $check = Schedule::where('start_from', Carbon::parse($request->start_from)->format('H:i:s'))->where('end_at', Carbon::parse($request->end_at)->format('H:i:s'))->first();

        if($check && $check->id != $id){
            toast('This schedule has already added','error')->width(350);
            return redirect()->back();
        }

        $schdule = Schedule::find($id);
        $schdule->start_from = $request->start_from;
        $schdule->end_at = $request->end_at;
        $schdule->save();

        toast('Schedule created successfully','success')->width(350);
        return redirect()->route('admin.schedule.index');
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
        $schedule = Schedule::findOrFail($id);
        $schedule->status = $schedule->status ? 0 : 1;
        $schedule->save();

        toast('Schedule status updated successfully','success')->width(350);
        return redirect()->back();
    }
}
