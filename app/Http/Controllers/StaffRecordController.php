<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Models\Notification;

use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

use Auth;

class StaffRecordController extends Controller
{
    //


    public function create_staff_account(Request $request)
    {

        $user_code = "ITL-".rand(11100,99999);

        $staff_record = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'user_code' => $user_code,
            'role' => $request->role,
            'password' => Hash::make($request->password)
        ]);


        $notification = Notification::create([
            'user_id' => Auth::user()->id,
            'title' => 'New Credential Created',
            'body' => 'You just created an account with email:' .$request->email .' and '.$request->password,
        ]);

        
        return back()->with('staff_record_msg', 'Staff Credentials Created');
    }


}
