<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AccountHead;

use App\Models\AccountSubHead;

use App\Models\AccountMapping;

class AccountMappingController extends Controller
{
    //

    public function map_account(Request $request)
    {
        # code...

        // dd($request->all());

        $mapping = AccountMapping::create([
            'account_heads_id' => $request->account_heads_id,
            'account_sub_head_id' => $request->account_sub_head_id,
        ]);


        return back()->with('map_msg', 'Successfully Created');
    }


    public function accounts_map(Request $request)
    {
        # code...

        $key = $request->key;


        try {
            //code...

            // $results = AccountMapping::
            // with('heads')
            // ->with('subheads')
            // ->where('heads.title', 'like', '%'.$key.'%')
            // ->where('subheads.title', 'like', '%'.$key.'%')
            // ->latest()->get();

            $results = AccountMapping::with('heads')->with('subheads')->whereHas('heads', function ($attachmentQuery) use($key) {
                $attachmentQuery->where('title','like', '%'. $key. '%');
            })
            ->OrwhereHas('subheads', function ($attachmentQuery2) use($key) {
                $attachmentQuery2->where('title','like', '%'. $key. '%');
            })
            ->get();

            return $results;

        } catch (\Throwable $th) {
            //throw $th;

            return $th;
        }
    }
}
