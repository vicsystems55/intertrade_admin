<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\TruckRoute;

use App\Models\Inventory;

use App\Models\Deployment;

use App\Models\Notification;

use App\Models\Message;

use App\Models\Stock;

use App\Models\Project;

use App\Models\AccountHead;

use App\Models\AccountSubHead;

use App\Models\AccountMapping;

use Carbon\Carbon;

use Auth;

class SuperAdminPageController extends Controller
{
    //

    public function index()
    {
        
        
        return view('superadmin_dashboard.index');
    }

    public function staff_records()
    {

        $users = User::latest()->get();
        
        
        return view('superadmin_dashboard.staff_records',[
            'users' => $users
        ]);
    }

    public function staff_record($user_id)
    {
        $user = User::where('id', $user_id)->first();
        
        return view('superadmin_dashboard.staff_record',[
            'user' => $user
        ]);
    }

    public function create_staff()
    {
        
        
        return view('superadmin_dashboard.create_staff');
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

        $messages = Message::with('fr_oms')->where('t_o', Auth::user()->id)->latest()->get();

        $users = User::latest()->get();
        
        
        return view('general.messages',[
            'messages' => $messages,
            'users' => $users
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

    public function create_deployment()
    {

        $deployments = Deployment::latest()->get();
        
        return view('superadmin_dashboard.create_deployment',[
            'deployments' => $deployments
        ]);
    }

    public function deployment($deployment_id)
    {

        $deployment = Deployment::where('id', $deployment_id)->first();
        
        
        return view('general.deployment',[
            'deployment' => $deployment
        ]);
    }

    public function create_truck_route()
    {


        $deployments = Deployment::latest()->get();

        $inventories = Inventory::latest()->get();

        $users = User::where('role', 'driver')->get();


        
        return view('superadmin_dashboard.create_truck_route',[
            'deployments' => $deployments,
            'inventories' => $inventories,
            'users' => $users,
        ]);
    }

    public function truck_routes()
    {

        $trucka_routes = TruckRoute::with('deployments')->where('inventory_id', 1)->latest()->get();

        $truckb_routes = TruckRoute::with('deployments')->where('inventory_id', 2)->latest()->get();
        
        
        return view('general.truck_routes',[
            'trucka_routes' => $trucka_routes,
            'truckb_routes' => $truckb_routes,
        ]);
    }

    public function inventories()
    {
        $inventories = Inventory::latest()->get();
                
        return view('admin_dashboard.inventories',[
            'inventories' => $inventories,
        ]);
    }

    public function projects()
    {

        $projects = Project::latest()->get();
        
        return view('admin_dashboard.projects',[

            'projects' => $projects

        ]);
    }
}
