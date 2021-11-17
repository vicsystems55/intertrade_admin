<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AccountHead;

use App\Models\AccountSubHead;

use App\Models\AccountMapping;

use App\Models\User;

use App\Models\Notification;

use App\Models\Requisition;

class AccountPageController extends Controller
{
    //

    public function index($page)
    {

    // return $page;


        $users = User::latest()->get();

        $notifications = Notification::latest()->get();

        $requisitions = Requisition::latest()->get();
        
        
        return view('accounts_dashboard.'.$page,[
            'notifications' => $notifications,
            'users' => $users,
            'requisitions' => $requisitions
        ]);
    }

    public function details($page, $id)
    {

    // return $page;


        $users = User::latest()->get();

        $notifications = Notification::latest()->get();
        
        
        return view('accounts_dashboard.'.$page,[
            'notifications' => $notifications,
            'users' => $users
        ]);
    }

    

   
    
}
