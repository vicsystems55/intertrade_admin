<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\ClientProject;
use App\Http\Requests\StoreClientProjectRequest;
use App\Http\Requests\UpdateClientProjectRequest;

class ClientProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $clientProjects = ClientProject::all();

        $customers = Customer::all();

        return view('admin_dashboard.clientProjects', compact(['clientProjects','customers']));

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return 123;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClientProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientProjectRequest $request)
    {
        //

        ClientProject::create($request->all());

        return back()->with('msg', 'Project Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClientProject  $clientProject
     * @return \Illuminate\Http\Response
     */
    public function show(ClientProject $clientProject)
    {
        //

        return view('admin_dashboard.clientProject', [
            'clientProject' => $clientProject->load('milestones')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClientProject  $clientProject
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientProject $clientProject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClientProjectRequest  $request
     * @param  \App\Models\ClientProject  $clientProject
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientProjectRequest $request, ClientProject $clientProject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClientProject  $clientProject
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientProject $clientProject)
    {
        //
    }
}
