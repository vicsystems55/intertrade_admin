<?php

namespace App\Http\Controllers;

use App\Models\SalaryStructure;
use Illuminate\Http\Request;

class SalaryStructureController extends Controller
{
    // read all

    public function index(Request $request){


        $salStructures = SalaryStructure::latest()->get();

        // return $salStructures;

    }

    // create

    public function store(Request $request){

        $request->validate([
            'designation' => 'required',
            'description' => 'required',
            'weight' => 'required',
            'basic' => 'required',
        ]);

        $salStructure = SalaryStructure::create([
            'designation' => $request->designation,
            'description' => $request->description,
            'weight' => $request->weight,
            'basic' => $request->basic,
        ]);

        return back()->with('msg', 'Salary Structure Entry Created');

    }

    // read one

    public function show($id){

        $salStructure = SalaryStructure::find($id);

        return $salStructure;
    }

    // update

    public function update(Request $request, $id){

        $salStructure = SalaryStructure::find($id)->update([
            'designation' => $request->designation,
            'description' => $request->description,
            'weight' => $request->weight,
            'basic' => $request->basic,
        ]);

        return $salStructure;
    }

    // destroy

    public function destroy($id){
        $salStructure = SalaryStructure::find($id)->delete();

        return back()->with('msg', 'Salary Structure Item removed');
    }
}
