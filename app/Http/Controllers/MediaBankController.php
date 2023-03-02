<?php

namespace App\Http\Controllers;

use App\Models\MediaBank;
use App\Http\Requests\StoreMediaBankRequest;
use App\Http\Requests\UpdateMediaBankRequest;

class MediaBankController extends Controller
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
     * @param  \App\Http\Requests\StoreMediaBankRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMediaBankRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MediaBank  $mediaBank
     * @return \Illuminate\Http\Response
     */
    public function show(MediaBank $mediaBank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MediaBank  $mediaBank
     * @return \Illuminate\Http\Response
     */
    public function edit(MediaBank $mediaBank)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMediaBankRequest  $request
     * @param  \App\Models\MediaBank  $mediaBank
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMediaBankRequest $request, MediaBank $mediaBank)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MediaBank  $mediaBank
     * @return \Illuminate\Http\Response
     */
    public function destroy(MediaBank $mediaBank)
    {
        //
    }
}
