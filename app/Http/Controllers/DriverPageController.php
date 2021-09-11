<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\TruckRoute;

use App\Models\Inventory;

use App\Models\Deployment;

use App\Models\Notification;

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

        $deployments = Deployment::latest()->get();

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

        $trucka_routes = TruckRoute::with('deployments')->with('drivers')->where('inventory_id', 1)->get();

        $truckb_routes = TruckRoute::with('deployments')->with('drivers')->where('inventory_id', 2)->get();
        
        return view('general.truck_routes',[

            'truck_routes' => $truck_routes,
            'trucka_routes' => $trucka_routes,
            'truckb_routes' => $truckb_routes,
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
        $users = User::latest()->get();
        
        return view('general.notifications',[
            'notifications' => $notifications,
            'users' => $users
        ]);
    }

    public function messages()
    {

        $messages = Message::where('t_o', Auth::user()->id)->get();
        $users = User::latest()->get();

        
        return view('general.messages',[
            'messages' => $messages,
            'users' => $users

            
        ]);
    }

    public function profile()
    {

        $user = User::where('id', Auth::user()->id)->first();
        
        return view('general.profile',[
            'user' => $user
        ]);
    }

    public function reports()
    {
        return view('driver_dashboard.reports');
    }


    public function projects()
    {

        $projects = Project::latest()->get();
        
        return view('general.projects',[

            'projects' => $projects

        ]);
    }

    public function project($project_id)
    {

        $project = Project::where('id', $project_id)->first();

        $deployments = Deployment::latest()->get();
        
        
        return view('general.project',[
            'project' => $project,
            'deployments' => $deployments
        ]);
    }

    
    public function deployments()
    {
        $project = Project::where('id', 1)->first();

        $deployments = Deployment::latest()->get();
        
        
        return view('general.deployments',[

            'deployments' => $deployments,
            'project' => $project
        ]);
    }
}
