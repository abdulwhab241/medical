<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Salary;
use App\Models\FundAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\SalaryRequest;

class SalaryController extends Controller
{
    public function index()
    {
        if(Auth::user()->job == 'admin')
        {
            $Salaries =  Salary::all();
            return view('Dashboard.Admin.Salaries.index',compact('Salaries'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }

    public function create()
    {
        if(Auth::user()->job == 'admin')
        {
            $Users = User::all();
            return view('Dashboard.Admin.Salaries.add',compact('Users'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }

    public function edit($id)
    {
        if(Auth::user()->job == 'admin')
        {
            $Salaries = Salary::findOrFail($id);
            return view('Dashboard.Admin.Salaries.edit',compact('Salaries'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }

    public function print()
    {
        if(Auth::user()->job == 'admin')
        {
            $Salaries = Salary::all();
            return view('Dashboard.Admin.Salaries.print',compact('Salaries'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }

    public function store(SalaryRequest $request)
    {

        if(Auth::user()->job == 'admin')
        {

            try{
                $Jobs = User::where('id', strip_tags($request->User_id))->pluck('job');

                $total = 0;
                $sub_total = strip_tags($request->Salary) + strip_tags($request->Suit);
                $total += $sub_total;
                $All = $sub_total - strip_tags($request->Discount);
    
                // store Salaries
                $Salaries = new Salary();
                $Salaries->user_employee_id = strip_tags($request->User_id);
                foreach($Jobs as $job)
                {
                    $Salaries->the_job = $job;
                }
                $Salaries->disc = strip_tags($request->Disc);
                $Salaries->the_salary = strip_tags($request->Salary);
                $Salaries->suits = strip_tags($request->Suit);
                $Salaries->discounts = strip_tags($request->Discount);
                $Salaries->total =  $All;
                $Salaries->date = date('y-m-d');
                $Salaries->year = date('Y');
                $Salaries->create_by  = auth()->user()->name;
                $Salaries->save();
    
                // store fund_accounts
                $fund_accounts = new FundAccount();
                $fund_accounts->salary_id = $Salaries->id;
                $fund_accounts->credit =  $All;
                $fund_accounts->disc = strip_tags($request->Disc);
                $fund_accounts->date =date('y-m-d');
                $fund_accounts->year = date('Y');
                $fund_accounts->create_by  = auth()->user()->name;
                $fund_accounts->save();


                toastr()->success('تم إضافة راتب الموظف بنجاح');
                return redirect()->route('Salary.index');
            }
    
            catch (\Exception $e) {
    
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }

    public function update(Request $request)
    {

        if(Auth::user()->job == 'admin')
        {

            try{
                $Jobs = User::where('id', strip_tags($request->User_id))->pluck('job');

                $total = 0;
                $sub_total = strip_tags($request->Salary) + strip_tags($request->Suit);
                $total += $sub_total;
                $All = $sub_total - strip_tags($request->Discount);
    
                // store Salaries
                $Salaries = Salary::findOrFail(strip_tags($request->id));;
                $Salaries->user_employee_id = strip_tags($request->User_id);
                foreach($Jobs as $job)
                {
                    $Salaries->the_job = $job;
                }
                $Salaries->disc = strip_tags($request->Disc);
                $Salaries->the_salary = strip_tags($request->Salary);
                $Salaries->suits = strip_tags($request->Suit);
                $Salaries->discounts = strip_tags($request->Discount);
                $Salaries->total =  $All;
                $Salaries->date = date('y-m-d');
                $Salaries->year = date('Y');
                $Salaries->create_by  = auth()->user()->name;
                $Salaries->save();
    
                // store fund_accounts
                $fund_accounts = FundAccount::where('salary_id',strip_tags($request->id))->first();
                // $fund_accounts->salary_id = $Salaries->id;
                $fund_accounts->credit =  $All;
                $fund_accounts->disc = strip_tags($request->Disc);
                $fund_accounts->date = date('y-m-d');
                $fund_accounts->year = date('Y');
                $fund_accounts->create_by  = auth()->user()->name;
                $fund_accounts->save();


                toastr()->success('تم تعديل راتب الموظف بنجاح');
                return redirect()->route('Salary.index');
            }
    
            catch (\Exception $e) {
    
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        if(Auth::user()->job == 'admin')
        {
            Salary ::destroy(strip_tags($request->id));
            FundAccount ::where('salary_id', strip_tags($request->id))->delete();

            toastr()->error('تم حذف راتب الموظف بنجاح');
            return redirect()->back();
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }

}
