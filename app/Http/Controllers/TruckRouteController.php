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



        $truck_route = TruckRoute::create([

            'deployment_id' => $request->deployment_id,
            'inventory_id' => $request->inventory_id,
            'pickup_date' => $request->pickup_date,
            'dropoff_date' => $request->dropoff_date,
            'driver_assigned' => $request->driver_assigned

        ]);




        return back()->with('truck_route_msg');
    }
}
