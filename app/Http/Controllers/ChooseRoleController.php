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
                return redirect('/staff');
            }

            elseif (Auth::user()->role =='driver') {
                return redirect('/staff');
            }
            elseif (Auth::user()->role =='superadmin') {
                return redirect('/admin');
            }

            elseif (Auth::user()->role =='client') {
                return redirect('/client');
            }

            elseif (Auth::user()->role =='accounts') {
                return redirect('/accounts');
            }

            else{
                abort(403);
            }
        }else{
            return redirect('/login');
        }
    }

}
