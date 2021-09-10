<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\TruckRoute;

use App\Models\Inventory;

use App\Models\Deployment;

use App\Models\Notifications;

use App\Models\Message;

use App\Models\Stock;

use App\Models\Project;

use App\Models\AccountHead;

use App\Models\AccountSubHead;

use App\Models\AccountMapping;

use Auth;

class AdminPageController extends Controller
{
    //

    public function index()
    {

        $projects = Project::latest()->get();

        $deployments = Deployment::latest()->get();

        $inventories = Inventory::latest()->get();

        $users = User::latest()->get();


        return view('admin_dashboard.index',[
            'projects' => $projects,
            'deployments' => $deployments,
            'inventories' => $inventories,
            'users' => $users
        ]);
    }

    public function inventories()
    {
        $inventories = Inventory::latest()->get();
                
        return view('admin_dashboard.inventories',[
            'inventories' => $inventories,
        ]);
    }

    public function inventory($inventory_id)
    {
        $inventory = Inventory::where('id', $inventory_id)->first();
        
        return view('admin_dashboard.inventory',[
            'inventory' => $inventory
        ]);
    }

    public function messages()
    {

        $messages = Message::latest()->get();
        
        
        return view('admin_dashboard.messages',[
            'messages' => $messages
        ]);
    }

    public function notifications()
    {

        $notifications = Notification::where('user_id', Auth::user()->id)->get();
        
        
        return view('admin_dashboard.notifications',[

            'notifications' => $notifications
            
        ]);
    }

    public function orders()
    {
        
        
        return view('admin_dashboard.orders');
    }

    public function order($order_id)
    {
        
        
        return view('admin_dashboard.order');
    }

    public function profile()
    {
        
        
        return view('admin_dashboard.profile');
    }

    public function reports()
    {
        
        
        return view('admin_dashboard.reports');
    }

    public function report()
    {
        
        
        return view('admin_dashboard.report');
    }

    public function staff_records()
    {
        $users = User::latest()->get();
        
        return view('admin_dashboard.staff_records',[
            'users' => $users
        ]);
    }

    public function staff_record()
    {
        
        
        return view('admin_dashboard.staff_record');
    }

    public function projects()
    {

        $projects = Project::latest()->get();
        
        return view('admin_dashboard.projects',[

            'projects' => $projects

        ]);
    }

    public function project($project_id)
    {
        $project = Project::where('id', $project_id)->first();
        
        
        return view('admin_dashboard.project',[
            'project' => $project
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
        
        
        return view('general.deployment',[
            'deployment' => $deployment
        ]);
    }
    
    public function truck_routes()
    {

        $truck_routes = TruckRoute::latest()->get();
        
        
        return view('general.truck_routes',[

            'truck_routes' => $truck_routes

        ]);
    }

    public function truck_route($truck_route_id)
    {

        $truck_routes = TruckRoute::where('id', $truck_route_id)->latest()->first();
        
        
        return view('general.truck_route',[

            'truck_routes' => $truck_routes
            
        ]);
    }



}
