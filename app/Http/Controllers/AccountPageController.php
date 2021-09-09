<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AccountHead;

use App\Models\AccountSubHead;

use App\Models\AccountMapping;

class AccountPageController extends Controller
{
    //

    public function index()
    {
        
        
        return view('accounts_dashboard.index');
    }

    public function coaccount()
    {

        $account_heads = AccountHead::latest()->get();

        $account_sub_heads = AccountSubHead::latest()->get();

        $account_mapings = AccountMapping::with('heads')->with('subheads')->latest()->get();

        
        
        return view('accounts_dashboard.coaccount',[
            'account_heads' => $account_heads,
            'account_sub_heads' => $account_sub_heads,
            'account_mapings' => $account_mapings,
        ]);
    }

    public function vouchers()
    {
        
        
        return view('accounts_dashboard.vouchers');
    }

    
}
