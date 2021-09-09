<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuperAdminPageController extends Controller
{
    //

    public function index()
    {
        
        
        return view('superadmin_dashboard.index');
    }
}
