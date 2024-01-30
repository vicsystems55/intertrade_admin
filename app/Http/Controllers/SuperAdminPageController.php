<?php

namespace App\Http\Controllers;


use Carbon\Carbon;

use App\Models\User;

use App\Models\Stock;

use App\Models\Invoice;

use App\Models\Message;

use App\Models\Product;

use App\Models\Project;

use App\Models\Customer;

use App\Models\Inventory;

use App\Models\Deployment;

use App\Models\TruckRoute;

use App\Models\AccountHead;

use App\Models\CashRequest;

use App\Models\ReportImage;

use App\Models\Notification;

use Illuminate\Http\Request;
use App\Models\AccountMapping;
use App\Models\AccountSubHead;
use App\Models\ProductCategory;
use App\Models\DeploymentReport;
use App\Models\InstallationSchedule;
use Illuminate\Support\Facades\Auth;
use App\Models\EmployeePaycheckSummary;
use Illuminate\Support\Facades\Session;



class SuperAdminPageController extends Controller
{
    //

    public function spo_reports()
    {



        return view('genral');
    }

    public function index()
    {

        $stocks = Stock::where('invoice_id', '!=', null )->with(['invoice','receiver'])->get();

        $total = Invoice::whereIn('id', $stocks->pluck('invoice_id'))->get()->sum('total_amount');



        // return $total;

        $orders = Invoice::where('customer_id','!=',null)->get();

        // return $orders;

        $products = Product::has('stock')->with('stock')->get();

        $customers = Customer::get();



        return view('superadmin_dashboard.index',compact(['products','stocks', 'total', 'orders', 'customers']));
    }

    public function staff_records()
    {

        $users = User::where('status',null)->latest()->get();


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

    public function customer()
    {
        $customers = Customer::all();

        return view('superadmin_dashboard.customer', compact('customers'));
    }

    public function cash_request()
    {
        $cash_requests = CashRequest::with('requestby')->get();

        // return $cash_requests;

        return view('superadmin_dashboard.cash_request', compact('cash_requests'));
    }

    public function cash_request_details($id)
    {
        $cash_request = CashRequest::with('requestby')->find($id);

        // return $cash_requests;

        return view('superadmin_dashboard.cash_request_details', compact('cash_request'));
    }

    public function create_staff()
    {


        return view('superadmin_dashboard.create_staff');
    }

    public function pos()
    {
        $invoices = Invoice::with('invoice_line.product')->get();

        return view('superadmin_dashboard.pos', compact(['invoices']));
    }

    public function notifications()
    {

        $notifications = Notification::where('user_id', Auth::user()->id)->latest()->paginate(10);

        $notificationx = Notification::where('user_id', Auth::user()->id)->update([
            'status' => 'read'
        ]);


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

    public function create_installation_schedule()
    {


        $deployments = Deployment::latest()->get();

        $inventories = Inventory::latest()->get();

        $users = User::where('role', 'technician')->get();



        return view('superadmin_dashboard.create_installation_schedule',[
            'deployments' => $deployments,
            'inventories' => $inventories,
            'users' => $users,
        ]);
    }

    public function installation_schedule(Request $request)
    {


        $key = $request->technician_assigned??'';


        $deployments = Deployment::latest()->get();

        $installation_schedules = InstallationSchedule::where('technician_assigned','Like', '%'.$key.'%')->with('deployments')->with('technicians')->orderBy('technician_assigned', 'asc')->latest()->get();

        $users = User::where('role', 'technician')->get();

        // dd($installation_schedules);



        return view('general.installation_schedule',[
            'deployments' => $deployments,
            'installation_schedules' => $installation_schedules,
            'users' => $users,
        ]);
    }

    public function truck_routes()
    {

        $trucka_routes = TruckRoute::with('deployments')->with('drivers')->where('inventory_id', 1)->get();

        $truckb_routes = TruckRoute::with('deployments')->with('drivers')->where('inventory_id', 2)->get();


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

    public function reports()
    {


        $reports = DeploymentReport::where('status', 'test')->with('report_images')->latest()->get();

        // dd($reports);


        return view('superadmin_dashboard.reports',[
            'reports' => $reports
        ]);
    }

    public function report($report_id)
    {

        $report = DeploymentReport::with('report_images')->where('id', $report_id)->first();




        return view('superadmin_dashboard.report',[
            'report' => $report,

        ]);
    }

    public function create_report()
    {
        $user_id = Auth::user()->id;

        // check if session exist with listing code


        $report = DeploymentReport::where('report_code', Session::get('report_code'))->where('reporter_id', $user_id)->first();

        if (Session::get('report_code') && $report) {
            # code...

            // dd(Session::get('listing_code'));

        }else{

           session([
                'report_code' => rand(11100,99999)
            ]);

            $report = DeploymentReport::create([
                'report_code' => Session::get('report_code'),
                'reporter_id' => $user_id,
                'status' => 'pending'
            ]);

            // dd($vehicle_listing);

        }

        $deployments = Deployment::latest()->get();


        return view('superadmin_dashboard.create_report',[
            'deployments' => $deployments
        ]);
    }

    // all products : admin page

    public function all_products(){

        $productCategories = ProductCategory::get();


        return view('superadmin_dashboard.products', compact('productCategories'));

    }

    public function product_categories(){

        return view('superadmin_dashboard.product_categories');

    }

    public function transactions(){

        return view('superadmin_dashboard.transactions');

    }

    public function file_manager(){

        return view('superadmin_dashboard.file_manager');

    }

    public function settings(){

        return view('superadmin_dashboard.settings');

    }

    public function payroll_records(){

        $empPaycheckSummary = EmployeePaycheckSummary::with('employee.salary_level')->latest()->get();

        // return $empPaycheckSummary;

        return view('superadmin_dashboard.payroll.payroll_records', compact('empPaycheckSummary'));
    }
    public function loans(){

        return view('superadmin_dashboard.payroll.loans');
    }
    public function payroll_settings(){

        return view('superadmin_dashboard.payroll.payroll_settings');
    }
}
