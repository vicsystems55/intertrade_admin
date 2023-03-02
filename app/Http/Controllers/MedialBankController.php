<?php

namespace App\Http\Controllers;

use App\Models\MedialBank;
use App\Http\Requests\StoreMedialBankRequest;
use App\Http\Requests\UpdateMedialBankRequest;

class MedialBankController extends Controller
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
     * @param  \App\Http\Requests\StoreMedialBankRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMedialBankRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MedialBank  $medialBank
     * @return \Illuminate\Http\Response
     */
    public function show(MedialBank $medialBank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MedialBank  $medialBank
     * @return \Illuminate\Http\Response
     */
    public function edit(MedialBank $medialBank)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMedialBankRequest  $request
     * @param  \App\Models\MedialBank  $medialBank
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMedialBankRequest $request, MedialBank $medialBank)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MedialBank  $medialBank
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedialBank $medialBank)
    {
        //
    }
}
