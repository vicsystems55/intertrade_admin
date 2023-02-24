<?php

namespace App\Http\Controllers;

use App\Models\CashRequest;
use Illuminate\Support\Facades\Auth;
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

        CashRequest::create([
            'title' => $request->title,
            'description'=> $request->description,
            'amount_requested' => $request->amount_requested,
            'request_by' => Auth::user()->id
        ]);

        

        return back()->with('cashMsg', 'Cash Request Submitted');
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
