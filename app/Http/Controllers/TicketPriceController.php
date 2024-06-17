<?php

namespace App\Http\Controllers;

use App\Models\FleetType;
use App\Models\TicketPrice;
use App\Models\TicketPriceByStoppage;
use App\Models\VehicleRoute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TicketPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fleetTypes = FleetType::active()->get();
        $routes = VehicleRoute::active()->get();
        $prices = TicketPrice::with(['fleetType', 'route'])->orderBy('id', 'desc')->paginate(getPaginate());
        return view('admin.trips.ticket_price.index', compact('prices', 'fleetTypes', 'routes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fleetTypes = FleetType::active()->get();
        $routes = VehicleRoute::active()->get();
        return view('admin.trips.ticket_price.create', compact('fleetTypes', 'routes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation_rule = [
            'fleet_type'    => 'required|integer|gt:0',
            'route'         => 'required|integer|gt:0',
            'main_price'    => 'required|numeric',
            'price'         => 'sometimes|required|array|min:1',
            'price.*'       => 'sometimes|required|numeric',
        ];
        $messages = [
            'main_price'            => 'Price for Source to Destination',
            'price.*.required'      => 'All Price Fields are Required',
            'price.*.numeric'       => 'All Price Fields Should Be a Number',
        ];

        $validator = Validator::make($request->except('_token'), $validation_rule, $messages);
        $validator->validate();

        $check = TicketPrice::where('fleet_type_id', $request->fleet_type)->where('vehicle_route_id', $request->route)->first();
        if ($check) {
            toast('Duplicate fleet type and route can\'t be allowed', 'error')->width(350);
            return back();
        }

        $create = new TicketPrice();
        $create->fleet_type_id = $request->fleet_type;
        $create->vehicle_route_id = $request->route;
        $create->price = $request->main_price;
        $create->save();

        if (!empty($request->price) && is_array($request->price)) {
            foreach ($request->price as $key => $val) {
                $idArray = explode('-', $key);
                $priceByStoppage = new TicketPriceByStoppage();
                $priceByStoppage->ticket_price_id = $create->id;
                $priceByStoppage->source_destination = $idArray;
                $priceByStoppage->price = $val;
                $priceByStoppage->save();
            }
        }
        toast('Ticket\'s Price created successfully', 'success')->width(350);
        return redirect()->route('admin.ticket-price.index');
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
        $ticketPrice = TicketPrice::with(['prices', 'route.startFrom', 'route.endTo'])->findOrfail($id);
        $stoppageArr = $ticketPrice->route->stoppages;
        $stoppages = stoppageCombination($stoppageArr, 2);

        return view('admin.trips.ticket_price.edit', compact('ticketPrice', 'stoppages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'price'   => 'required|numeric',
        ]);

        if ($id == 0) {
            $source_destination[0] = $request->source;
            $source_destination[1] = $request->destination;
            $ticketPrice = TicketPriceByStoppage::whereJsonContains('source_destination', $source_destination)->first();
            if ($ticketPrice) {
                $ticketPrice->price = $request->price;
                $ticketPrice->save();
            } else {
                $ticketPrice = new TicketPriceByStoppage();
                $ticketPrice->ticket_price_id = $request->ticket_price;
                $ticketPrice->source_destination = $source_destination;
                $ticketPrice->price = $request->price;
                $ticketPrice->save();
            }
        } else {
            $prices = TicketPriceByStoppage::findOrFail($id);
            $prices->price = $request->price;
            $prices->save();
        }

        
        return response()->json(['success' => true, 'message' => 'Ticket\'s Price Updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $item = TicketPrice::findOrFail($id);
        $item->delete();
        toast('Ticket\'s Price Deleted successfully', 'error')->width(350);
        return  redirect()->route('admin.ticket-price.index');
    }

    public function getRouteData(Request $request)
    {
        $route      = VehicleRoute::where('id', $request->vehicle_route_id)->where('status', 1)->first();
        $check      = TicketPrice::where('vehicle_route_id', $request->vehicle_route_id)->where('fleet_type_id', $request->fleet_type_id)->first();
        if ($check) {
            return response()->json(['error' => trans('You have added prices for this fleet type on this route')]);
        }
        $stoppages  = array_values($route->stoppages);
        $stoppages  = stoppageCombination($stoppages, 2);
        return view('admin.trips.ticket_price.route_data', compact('stoppages', 'route'));
    }
}
