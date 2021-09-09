<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    //

    public function index()
    {
        
        
        return view('admin_dashboard.index');
    }

    public function inventories()
    {
        
        
        return view('admin_dashboard.inventories');
    }

    public function inventory($inventory_id)
    {
        
        
        return view('admin_dashboard.inventory');
    }

    public function messages()
    {
        
        
        return view('admin_dashboard.messages');
    }

    public function notifications()
    {
        
        
        return view('admin_dashboard.notifications');
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
        
        
        return view('admin_dashboard.staff_records');
    }

    public function staff_record()
    {
        
        
        return view('admin_dashboard.staff_record');
    }

    public function projects()
    {
        
        
        return view('admin_dashboard.projects');
    }

    public function project($project_id)
    {
        
        
        return view('admin_dashboard.project');
    }


}
