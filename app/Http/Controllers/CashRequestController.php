<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CashRequest;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Mail\CashRequestMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreCashRequestRequest;
use App\Http\Requests\UpdateCashRequestRequest;

class CashRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCashRequestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCashRequestRequest $request)
    {
        //

        $cash_request = CashRequest::create([
            'title' => $request->title,
            'description'=> $request->description,
            'amount_requested' => $request->amount_requested,
            'request_by' => Auth::user()->id
        ]);



        Notification::create([
            'user_id' => $cash_request->request_by,
            'title' => 'Cash Request',
            'body' => 'You cash request of N '. number_format($cash_request->amount_requested, 2).' has been submitted.',
        ]);

        // get accountant
        // get md
        // get super admin

        $accountant = User::where('email', 'felix@intertradeltd.biz')->first();
        $super_admin = User::where('email', 'victor@intertradeltd.biz')->first();
        $ceo = User::where('email', 'eghosa@intertradeltd.biz')->first();


        Notification::create([
            'user_id' => $accountant->id,
            'title' => 'New Cash Request',
            'body' => 'A cash request of N '. number_format($cash_request->amount_requested, 2).' has been submitted, by '. Auth::user()->name. ': ' .Auth::user()->email,
        ]);

        Notification::create([
            'user_id' => $super_admin->id,
            'title' => 'New Cash Request',
            'body' => 'A cash request of N '. number_format($cash_request->amount_requested, 2).' has been submitted, by '. Auth::user()->name. ': ' .Auth::user()->email,
        ]);



        $data = [
            'requested_by_name' => Auth::user()->name,
            'requested_by_email' => Auth::user()->email,
            'title' => $cash_request->title,
            'amount' => $cash_request->amount_requested,
            'status' => ''
        ];


        Mail::to([
            'eghosa@intertradeltd.biz',
            'victor@intertradeltd.biz',
            'victorasuquob@gmail.com'
        ])->send(new CashRequestMail($data));



        return back()->with('cashMsg', 'Cash Request Submitted');
    }


    public function approveCashRequest(Request $request){

        // return $request->all();

        $status = $request->status;

        $cash_request = CashRequest::find($request->cash_request_id);

        $cash_request->update([
            'amount_approved' => $request->amount_approved,
            'status' => $status,
            'approved_by' => Auth::user()->id,

        ]);

        Notification::create([
            'user_id' => $cash_request->request_by,
            'title' => 'Cash Request '.$status,
            'body' => 'Your cash request of N '. number_format($cash_request->amount_requested, 2).' has been '.$status,
        ]);
        $accountant = User::where('email', 'felix@intertradeltd.biz')->first();
        $super_admin = User::where('email', 'victor@intertradeltd.biz')->first();
        $ceo = User::where('email', 'eghosa@intertradeltd.biz')->first();


        Notification::create([
            'user_id' => $accountant->id,
            'title' => 'Cash Request '.$status,
            'body' => 'Cash request of N '. number_format($cash_request->amount_requested, 2).' has been '.$status,
        ]);

        Notification::create([
            'user_id' => $super_admin->id,
            'title' => 'Cash Request '.$status,
            'body' => 'Cash request of N '. number_format($cash_request->amount_requested, 2).' has been '.$status,
        ]);



        $data = [
            'requested_by_name' => Auth::user()->name,
            'requested_by_email' => Auth::user()->email,
            'title' => $cash_request->title,
            'amount' => $cash_request->amount_requested,
            'status' => $status
        ];


        Mail::to([
            'victor@intertradeltd.biz',
            'victorasuquob@gmail.com'
        ])->send(new CashRequestMail($data));


        return back()->with('cashAppMsg', 'Cash Request '.$status);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CashRequest  $cashRequest
     * @return \Illuminate\Http\Response
     */
    public function show(CashRequest $cashRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCashRequestRequest  $request
     * @param  \App\Models\CashRequest  $cashRequest
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCashRequestRequest $request, CashRequest $cashRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CashRequest  $cashRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(CashRequest $cashRequest)
    {
        //
    }
}
