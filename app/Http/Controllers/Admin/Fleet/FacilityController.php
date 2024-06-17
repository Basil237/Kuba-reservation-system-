<?php

namespace App\Http\Controllers\Admin\Fleet;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $facilities = Facility::all();
        return view('admin.fleet.facility.index', compact('facilities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.fleet.facility.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:facilities',
            'details' => 'required',
            'icon' => 'required',
        ]);

        $facility = new Facility();
        $facility->title = $request->title;
        $facility->details = $request->details;
        $facility->icon = $request->icon;
        $facility->save();

        toast('Facility created successfully', 'success')->width('350');
        return redirect()->route('admin.facilities.index');
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
        $facility = Facility::findOrFail($id);
        return view('admin.fleet.facility.edit', compact('facility'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $facility = Facility::findOrFail($id);
        $facility->title = $request->title;
        $facility->details = $request->details;
        $facility->icon = $request->icon;
        $facility->save();

        toast('Facility Updated successfully', 'success')->width('350');
        return redirect()->route('admin.facilities.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $layout = Facility::findOrFail($id);
        $layout->delete();
        return  redirect()->route('admin.facilities.index');
    }
}
