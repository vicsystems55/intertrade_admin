<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\EmployeeDeduction;
use App\Models\EmployeePaycheckItem;

class EmployeePaycheckSummaryController extends Controller
{
    //

    public function generatePaycheckSummary($user_id){

        $payroll_id = 1;

        $userData = User::find($user_id);

        // get all paycheck items

        $employeePaycheckItems = EmployeePaycheckItem::with('paycheckItem')->
        where('payroll_id', $payroll_id)
        ->where('user_id', $user_id)
        ->get();

        // return $employeePaycheckItems;


        // get all deductions

        $employeeDeductions = EmployeeDeduction::with('deductionable')
        ->where('payroll_id', $payroll_id)
        ->where('user_id', $user_id)
        ->get();


        // return $employeeDeductions;

        return view('reports.paycheck_summary', compact('userData', 'employeePaycheckItems','employeeDeductions'));


    }
}
