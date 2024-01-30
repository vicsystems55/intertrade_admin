<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\EmployeeBioData;

class EmployeeBioDataController extends Controller
{
    //

    public function store(Request $request){



        $employeeData = EmployeeBioData::updateOrCreate([
            'surname' => $request->surname,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'user_id' => $request->user_id,
        ],[
            'user_id' => $request->user_id,
            'surname' => $request->surname,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'state' => $request->state,
            'lga' => $request->lga,
            'gender' => $request->gender,
            'marital_status' => $request->marital_status,
            'address' => $request->address,
            'phone' => $request->phone,
            'phone2' => $request->phone2,
            'phone3' => $request->phone3,
            'spouse_phone' => $request->spouse_phone,
            'ec_name' => $request->ec_name,
            'ec_phone' => $request->ec_phone,
            'ec_address' => $request->ec_address,
            'nok_name' => $request->nok_name,
            'nok_phone' => $request->nok_phone,
            'nok_address' => $request->nok_address,
            'date_employed' => $request->date_employed,
            'position_held' => $request->position_held,
            'refree1_name' => $request->refree1_name,
            'refree1_phone' => $request->refree1_phone,
            'refree1_address' => $request->refree1_address,
            'refree2_name' => $request->refree2_name,
            'refree2_phone' => $request->refree2_phone,
            'refree2_address' => $request->refree2_address,
        ]);


        return redirect('/update-success');
    }

    public function update_success(){


        return view('general.update_success');
    }

    public function update_pix(Request $request){



        // return $request->all();
        $passport_file = $request->file('avatar');

        $path = $passport_file->store('avatars', 'public');

      


        User::find($request->user_id)->update([
            'avatar' => $path
        ]);


        return back()->with('msgp', 'Passport updated.');

    }
}
