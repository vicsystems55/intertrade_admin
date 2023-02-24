<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FilemanagerController extends Controller
{
    //

    public function media()
    {


        return view('filemanager.home');
    }
}
