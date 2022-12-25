<?php

namespace App\Http\Controllers;

use App\Models\InvoiceLine;
use App\Http\Requests\StoreInvoiceLineRequest;
use App\Http\Requests\UpdateInvoiceLineRequest;

class InvoiceLineController extends Controller
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
     * @param  \App\Http\Requests\StoreInvoiceLineRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInvoiceLineRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InvoiceLine  $invoiceLine
     * @return \Illuminate\Http\Response
     */
    public function show(InvoiceLine $invoiceLine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInvoiceLineRequest  $request
     * @param  \App\Models\InvoiceLine  $invoiceLine
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInvoiceLineRequest $request, InvoiceLine $invoiceLine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InvoiceLine  $invoiceLine
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvoiceLine $invoiceLine)
    {
        //
    }
}
