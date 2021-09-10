<?php

namespace App\Http\Controllers;

use App\Models\TruckRoute;

use App\Models\User;

use App\Models\Inventory;

use App\Models\Deployment;

use App\Models\Notifications;

use Carbon\Carbon;

use Auth;

use Illuminate\Http\Request;

class TruckRouteController extends Controller
{
    //

    public function create_truck_route(Request $request)
    {
        # code...

        $request->validate([
            'deployment_id' => 'required|unique:truck_routes',
            // 'driver_assigned' => 'required|unique:truck_routes',
            // 'amount' => 'required|numeric|min:99700|between:0,99.99',
            // 'number_of_accounts' => 'required|numeric|min:1|max:15',
            // 'file' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            
        ]);




        $truck_route = TruckRoute::create([

            'deployment_id' => $request->deployment_id,
            'inventory_id' => $request->inventory_id,
            'pickup_date' => $request->pickup_date,
            'dropoff_date' => $request->dropoff_date,
            'driver_assigned' => $request->driver_assigned

        ]);




        return back()->with('truck_route_msg', 'Route Registered Successfully');
    }
}
