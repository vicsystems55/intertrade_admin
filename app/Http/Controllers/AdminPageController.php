<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Models\Stock;

use App\Models\Message;

use App\Models\Project;

use App\Models\Inventory;

use App\Models\Deployment;

use App\Models\TruckRoute;

use App\Models\AccountHead;

use App\Models\ReportImage;

use App\Models\Notification;

use Illuminate\Http\Request;

use App\Models\AccountMapping;

use App\Models\AccountSubHead;

use App\Models\DeploymentReport;



use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;




class AdminPageController extends Controller
{
    //

    public function index()
    {

        $projects = Project::latest()->get();

        $deployments = Deployment::latest()->get();

        $successful_deployments = Deployment::where('status', 'delivered')->latest()->get();

        $inventories = Inventory::latest()->get();

        $users = User::latest()->get();

        $reports = DeploymentReport::with('reporters')->where('status', 'submitted')->latest()->get();

        // dd($reports);


        return view('admin_dashboard.index',[
            'projects' => $projects,
            'deployments' => $deployments,
            'successful_deployments' => $successful_deployments,
            'inventories' => $inventories,
            'users' => $users,
            'reports' => $reports
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

        $messages = Message::with('fr_oms')->where('t_o', Auth::user()->id)->latest()->get();

        $users = User::latest()->get();


        return view('general.messages',[
            'messages' => $messages,
            'users' => $users
        ]);
    }



    public function notifications()
    {

      event(new \App\Events\SmartMessageEvent('newTask'));

        // dd($event);

        $notifications = Notification::where('user_id', Auth::user()->id)->latest()->get();
        

        $notificationx = Notification::where('user_id', Auth::user()->id)->update([
            'status' => 'read'
        ]);


        return view('general.notifications',[

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


        $reports = DeploymentReport::where('status', 'submitted')->with('report_images')->with('reporters')->latest()->get();

        // dd($reports);



        return view('admin_dashboard.reports',[
            'reports' => $reports
        ]);
    }

    public function report($report_id)
    {

        $report = DeploymentReport::with('report_images')->with('reporters')->where('id', $report_id)->first();




        return view('admin_dashboard.report',[
            'report' => $report,

        ]);
    }

    public function staff_records()
    {
        $users = User::latest()->get();

        return view('admin_dashboard.staff_records',[
            'users' => $users
        ]);
    }

    public function staff_record($user_id)
    {
        $user = User::where('id', $user_id)->first();


        return view('admin_dashboard.staff_record',[
            'user' => $user
        ]);
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

        $deployments = Deployment::latest()->get();


        return view('admin_dashboard.project',[
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

    public function deployment($deployment_id)
    {

        $deployment = Deployment::where('id', $deployment_id)->first();


        return view('general.deployment',[
            'deployment' => $deployment
        ]);
    }

    public function truck_routes()
    {

        $trucka_routes = TruckRoute::with('deployments')->with('drivers')->where('inventory_id', 1)->get();

        $truckb_routes = TruckRoute::with('deployments')->with('drivers')->where('inventory_id', 2)->get();

        // dd($trucka_routes);


        return view('general.truck_routes',[

            'trucka_routes' => $trucka_routes,
            'truckb_routes' => $truckb_routes,

        ]);
    }

    public function truck_route($truck_route_id)
    {

        $truck_routes = TruckRoute::where('id', $truck_route_id)->latest()->first();


        return view('general.truck_route',[

            'truck_routes' => $truck_routes

        ]);
    }



    public function ucc_update()
    {
        # code...


        return redirect('https://docs.google.com/spreadsheets/d/1TQn_KI1BcH2KxAEvQmKqcJgwLPAKWF0X8zegOQ0RP1E/edit#gid=0');
    }



}
