<?php

namespace App\Http\Controllers;

use App\Models\Message;

use Auth;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    //

    public function send_message(Request $request)
    {
        # code...
        // dd($request->all());

        $message = Message::create([
            't_o' => $request->t_o,
            'title' => $request->title,
            'body' => $request->body,
            'fr_om' => Auth::user()->id

        ]);

        return back()->with('message', 'Message Sent');
    }
}
