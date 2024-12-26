<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    //

    public function createRoot(Request $request){

        $rootFolder = Folder::create([
            'name' => $request->name
        ]);

    }
}
