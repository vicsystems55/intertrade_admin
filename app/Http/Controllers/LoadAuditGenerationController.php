<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoadAuditGenerationController extends Controller
{
    //

    public function generateAudit(Request $request){


        return $request->all();



    }
}
