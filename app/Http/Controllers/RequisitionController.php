<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Requisition;

use Session;

use Illuminate\Support\Facades\Auth;

class RequisitionController extends Controller
{
    //

    public function create_requisition(Request $request)
    {

        // return dd($request->all());

        
        $requistion = Requisition::create([
            'department' => $request->department,
            'amount_requested' => $request->amount_requested,
            'requested_by' => auth()->user()->id,
            'description' => $request->description,
        ]);


        // return $requistion;
    }

    public function approve(Request $request)
    {
        $requistion = Requisition::where('id', $request->id)->update([
            'approved_by' => Auth::user()->id,
            'approver_signature' => $request->approver_signature,
            'amount_approved' => $request->amount_approved,
            'status' => 'approved'
        ]);


        return $requistion;
    }

    public function disapprove(Request $request)
    {
        $requistion = Requisition::where('id', $request->id)->update([
            'approved_by' => '',
            'approver_signature' => '',
            'amount_approved' => '',
            'status' => 'disapproved'
        ]);


        return $requistion;
    }


    public function requistion(Request $request)
    {
        $requistion = Requisition::where('id', $request->id)->first();


        return $requistion;
    }

    public function update(Request $request)
    {
        $requistion = Requisition::where('id', $request->id)->update([
            'department' => $request->department,
            'amount_requested' => $request->amount_requested,
            'requested_by' => Auth::user()->id,
            'description' => $request->description,
        ]);


        return $requistion;
    }

    public function requisitions()
    {
        $requistions = Requisition::latest()->get();


        return $requistions;
    }
}
