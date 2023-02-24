<?php

namespace App\Http\Controllers;

use App\Models\MilestoneReport;
use App\Http\Requests\StoreMilestoneReportRequest;
use App\Http\Requests\UpdateMilestoneReportRequest;

class MilestoneReportController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMilestoneReportRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMilestoneReportRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MilestoneReport  $milestoneReport
     * @return \Illuminate\Http\Response
     */
    public function show(MilestoneReport $milestoneReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MilestoneReport  $milestoneReport
     * @return \Illuminate\Http\Response
     */
    public function edit(MilestoneReport $milestoneReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMilestoneReportRequest  $request
     * @param  \App\Models\MilestoneReport  $milestoneReport
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMilestoneReportRequest $request, MilestoneReport $milestoneReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MilestoneReport  $milestoneReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(MilestoneReport $milestoneReport)
    {
        //
    }
}
