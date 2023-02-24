<?php

namespace App\Http\Controllers;

use App\Models\ProjectMilestone;
use App\Http\Requests\StoreProjectMilestoneRequest;
use App\Http\Requests\UpdateProjectMilestoneRequest;

class ProjectMilestoneController extends Controller
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
     * @param  \App\Http\Requests\StoreProjectMilestoneRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectMilestoneRequest $request)
    {
        //

        $milestones = ProjectMilestone::create([
            'client_project_id' => $request->client_project_id,
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date
        ]);

        return back()->with('msg_milestones', 'Milestone created!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectMilestone  $projectMilestone
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectMilestone $projectMilestone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectMilestone  $projectMilestone
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectMilestone $projectMilestone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectMilestoneRequest  $request
     * @param  \App\Models\ProjectMilestone  $projectMilestone
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectMilestoneRequest $request, ProjectMilestone $projectMilestone)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectMilestone  $projectMilestone
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectMilestone $projectMilestone)
    {
        //
    }
}
