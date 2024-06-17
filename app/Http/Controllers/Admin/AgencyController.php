<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAgencyStoreRequest;
use App\Models\Agency;
Use Alert;
use App\Http\Requests\AdminAgencyUpdateRequest;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    public function index()
    {
        $emptyMessage = 'No Agency Found';
        $agencies = Agency::all();
        return view('admin.agency.index', compact('agencies','emptyMessage'));
    }

    public function create()
    {
        return view('admin.agency.create');
    }

    public function store(AdminAgencyStoreRequest $request)
    {
        $agency = new Agency();

        $agency->name = $request->name;
        $agency->city = $request->city;
        $agency->location = $request->location;
        $agency->mobile = $request->mobile;
        $agency->save();

        toast('Agency created successfully','success')->width(350);
        return redirect()->route('admin.agencies.index');
    }
    public function edit(string $id)
    {
        $agency = Agency::findOrFail($id);
        return view('admin.agency.edit', compact('agency'));
    }
    public function update(AdminAgencyUpdateRequest $request, string $id)
    {
        $agency = Agency::findOrFail($id);

        $agency->name = $request->name;
        $agency->city = $request->city;
        $agency->location = $request->location;
        $agency->mobile = $request->mobile;
        $agency->save();

        toast('Agency updated successfully','success')->width(350);
        return redirect()->route('admin.agencies.index');
    }

    public function toggleStatus(string $id)
    {
        $agency = Agency::findOrFail($id);
        $agency->status = $agency->status ? 0 : 1;
        $agency->save();

        toast('Agency status updated successfully','success')->width(350);
        return redirect()->back();
    }
}

