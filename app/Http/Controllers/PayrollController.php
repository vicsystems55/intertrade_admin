<?php

namespace App\Http\Controllers;

use App\Models\CustomDeduction;
use App\Models\Deduction;
use App\Models\EmployeeDeduction;
use App\Models\EmployeePaycheckItem;
use App\Models\EmployeePaycheckSummary;
use App\Models\LoanSchedule;
use App\Models\PaycheckItem;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Payroll;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    //

    public function generateSchedule(Request $request)
    {

        $request->validate([
            'date' => 'required',
            'days' => 'required',
        ]);

        $payroll = Payroll::create([
            'code' => rand(100, 999),
            'date' => Carbon::parse($request->date),
            'days' => $request->days,
        ]);


        return back()->with('msg', 'Schedule generated successfully');
    }

    public function generatePaychecks(Request $request)
    {

        // get payroll id

        $payroll_id = Payroll::find(1)->id;

        // return $payroll_id;

        // get every users eligible

        $users = User::with('salary_level')->where('salary_structure_id', '!=', null)->get();

        // return $users;

        // prepare all employee paycheck items

        $paycheckItems = PaycheckItem::get();

        // return $paycheckItems;

        foreach ($users as $key => $user) {
            # code...

            foreach ($paycheckItems as $payItemKey => $paycheckItem) {
                # code...

                EmployeePaycheckItem::updateOrCreate([
                    'user_id' => $user->id,
                    'paycheck_item_id' => $paycheckItem->id,

                ], [
                    'payroll_id' => $payroll_id,
                    'user_id' => $user->id,
                    'paycheck_item_id' => $paycheckItem->id,
                    'amount' => $user->salary_level->gross * $paycheckItem->per_gross,
                    'status' => 'active'
                ]);
            }
        }

        // return EmployeePaycheckItem::where('user_id', 1)->get();


        // prepare all employee paycheck deductions

        // general deductions

        $allDeductions = Deduction::get();

        // return $allDeductions;

        $customDeductions = CustomDeduction::get();

        // return $customDeductions;

        foreach ($users as $key => $user) {

            foreach ($allDeductions as $allDeductionKey => $deduction) {

                EmployeeDeduction::updateOrCreate([
                    'user_id' => $user->id,
                    'deductionable_type' => get_class($deduction),
                    'deductionable_id' => $deduction->id,

                ], [
                    'payroll_id' => $payroll_id,
                    'user_id' => $user->id,
                    'deductionable_type' => get_class($deduction),
                    'deductionable_id' => $deduction->id,
                    'amount' => $user->salary_level->gross * $deduction->per_deduct,
                    'status' => 'active'
                ]);
            }



            // custom deductions

            foreach ($customDeductions as $custDeductionKey => $customDeduct) {
                # code...



                // search for the right person

                $customDeduct = $customDeduct->where('salary_structure_id', $user->salary_level->id)->first();

                // return $customDeduct;

                EmployeeDeduction::updateOrCreate([
                    'user_id' => $user->id,
                    'deductionable_type' => get_class($customDeduct),
                    'deductionable_id' => $customDeduct->id,

                ], [
                    'payroll_id' => $payroll_id,
                    'user_id' => $user->id,
                    'deductionable_type' => get_class($customDeduct),
                    'deductionable_id' => $customDeduct->id,
                    'amount' => $customDeduct->amount,
                    'status' => 'active'
                ]);
            }
        }

        // return EmployeeDeduction::where('user_id', 4)->get();


        // check for loans deductions that are due i.e schedule date and paroll date in the same month
        $currentMonth = Carbon::now()->month;

        // return $currentMonth;

        $payrollMonth = Carbon::parse(Payroll::find(1)->date)->month;

        // return $payrollMonth;


        foreach ($users as $key => $user) {

            $loanSchedules = LoanSchedule::where('user_id', $user->id)->get();

            if (count($loanSchedules) > 0) {
                # code...

                foreach ($loanSchedules as $loanSchedulesKey => $loanSchedule) {
                    # code...

                    $loanScheduleMonth = Carbon::parse($loanSchedule->scheduled_date)->month;

                    // return $loanScheduleMonth;

                    if ($loanScheduleMonth == $currentMonth) {
                        # code...
                        EmployeeDeduction::updateOrCreate([
                            'user_id' => $user->id,
                            'deductionable_type' => get_class($loanSchedule),
                            'deductionable_id' => $loanSchedule->id,

                        ], [
                            'payroll_id' => $payroll_id,
                            'user_id' => $user->id,
                            'deductionable_type' => get_class($loanSchedule),
                            'deductionable_id' => $loanSchedule->id,
                            'amount' => $loanSchedule->amount_due,
                            'status' => 'active',
                        ]);
                    }
                }
            }

            // return $loanSchedules;



        }


        // generate paycheck summary

        foreach ($users as $userKey => $user) {
            # code...

            $totalDeductions = EmployeeDeduction::where('payroll_id', $payroll_id)->where('user_id', $user->id)->get()->sum('amount');

            $totalEarnings = EmployeePaycheckItem::where('payroll_id', $payroll_id)->where('user_id', $user->id)->get()->sum('amount');


            EmployeePaycheckSummary::updateOrCreate([
                'user_id' => $user->id,
            ], [
                'payroll_id' => $payroll_id,
                'user_id' => $user->id,
                'total_deductions' => $totalDeductions,
                'net_pay' => (($totalEarnings + $user->salary_level->basic) - $totalDeductions),
                'gross_pay' => $user->salary_level->gross,
                'status' => 'done',
            ]);
        }

        return EmployeePaycheckSummary::get();
    }
}
