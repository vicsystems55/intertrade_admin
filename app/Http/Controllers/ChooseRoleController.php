<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class ChooseRoleController extends Controller
{
    //

    public function choose()
    {
        if (Auth::check()) {
            # code...
            if (Auth::user()->role =='admin') {
                return redirect('/admin');
            }
    
            elseif (Auth::user()->role =='technician') {
                return redirect('/technician');
            }
    
            elseif (Auth::user()->role =='driver') {
                return redirect('/driver');
            }
            elseif (Auth::user()->role =='superadmin') {
                return redirect('/superadmin');
            }
    
            elseif (Auth::user()->role =='client') {
                return redirect('/client');
            }
    
            else{
                abort(403);
            }
        }else{
            return redirect('/login');
        }
    }

}
