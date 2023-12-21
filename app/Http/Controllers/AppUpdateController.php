<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppUpdateController extends Controller
{
    //

    public function updateApp(Request $request){
        $output = shell_exec('git pull');

        // You can return a response or redirect as needed
        // return response()->json(['output' => $output]);



        return back()->with('message', $output);
    }
}
