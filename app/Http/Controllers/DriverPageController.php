<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\TruckRoute;

use App\Models\Inventory;

use App\Models\Deployment;

use App\Models\Notifications;

use App\Models\Message;

use App\Models\Project;

use Auth;


class DriverPageController extends Controller
{
    //

    public function index()
    {


        $user_id = Auth::user()->id;

        $projects = Project::latest()->get();

        $deployments = Deployments::latest()->get();

        $truck_routes = TruckRoute::where('driver_assigned', $user_id)->latest()->get();


        
        return view('driver_dashboard.index',[
            'projects' => $projects,
            'deployments' => $deployments,
            'truck_routes' => $truck_routes
        ]);
    }

    public function truck_routes()
    {

        $user_id = Auth::user()->id;

        $truck_routes = TruckRoute::where('driver_assigned', $user_id)->first();
        
        return view('general.truck_routes',[

            'truck_routes' => $truck_routes

        ]);
    }

    public function deployments()
    {

        $deployments = Deployment::latest()->get();
        
        return view('general.deployments',[
            'deployments' => $deployments
        ]);
    }

    public function deployment($deployment_id)
    {

        $deployment = Deployment::where('id', $deployment_id)->first();
        
        return view('general.deployment');
    }

    public function notifications()
    {

        $notifications = Notification::where('user_id', Auth::user()->id)->get();
        
        return view('general.notifications',[
            'notifications' => $notifications
        ]);
    }

    public function messages()
    {

        $messages = Message::where('_to', Auth::user()->id)->get();
        
        return view('general.messages',[
            'messages' => $messages
        ]);
    }

    public function profile()
    {

        $user = User::where('id', Auth::user()->id)->first();
        
        return view('general.profile',[
            'user' => $user
        ]);
    }
}
