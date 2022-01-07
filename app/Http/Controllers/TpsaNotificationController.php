<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;

use App\Mail\NewUpdate;

class TpsaNotificationController extends Controller
{
    //


    public function notify_email(Request $request)
    {
        # code...


        $datax = [
            'name' => $request->name,
            'message' => $request->message,
        ];

        // try {
            //code...

            Mail::to($request->email)
            ->send(new NewUpdate($datax));




        return response()->json([
            'user_data' => 123,
        
        ]); 
    }
}
