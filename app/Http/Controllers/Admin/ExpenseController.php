<?php

namespace App\Http\Controllers\Admin;

use App\Models\Expense;
use App\Models\FundAccount;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\ExpenseRequest;

class ExpenseController extends Controller
{
    public function index()
    {
        if(Auth::user()->job == 'admin')
        {
            $Expenses =  Expense::all();
            return view('Dashboard.Admin.Expenses.index',compact('Expenses'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }

    public function create()
    {
        if(Auth::user()->job == 'admin')
        {
            return view('Dashboard.Admin.Expenses.add');
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }

    public function edit($id)
    {
        if(Auth::user()->job == 'admin')
        {
            $Expenses = Expense::findOrFail($id);
            return view('Dashboard.Admin.Expenses.edit',compact('Expenses'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }

    public function print()
    {
        if(Auth::user()->job == 'admin')
        {
            $Expenses = Expense::all();
            return view('Dashboard.Admin.Expenses.print',compact('Expenses'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }

    public function store(ExpenseRequest $request)
    {

        if(Auth::user()->job == 'admin')
        {

            try{

                // store Expenses
                $Expenses = new Expense();
                $Expenses->name = strip_tags($request->Name);
                $Expenses->price = strip_tags($request->Price);
                $Expenses->disc = strip_tags($request->Disc);
                $Expenses->date = date('y-m-d');
                $Expenses->year = date('Y');
                $Expenses->create_by  = auth()->user()->name;
                $Expenses->save();
    
                // store fund_accounts
                $fund_accounts = new FundAccount();
                $fund_accounts->expense_id = $Expenses->id;
                $fund_accounts->credit = strip_tags($request->Price);
                $fund_accounts->disc = strip_tags($request->Disc);
                $fund_accounts->date =date('y-m-d');
                $fund_accounts->year = date('Y');
                $fund_accounts->create_by  = auth()->user()->name;
                $fund_accounts->save();

    
    
                toastr()->success('تم إضافة المصروف بنجاح');
                return redirect()->route('Expense.index');
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

                // update Expenses
                $Expenses = Expense::findOrFail(strip_tags($request->id));
                $Expenses->name = strip_tags($request->Name);
                $Expenses->price = strip_tags($request->Price);
                $Expenses->disc = strip_tags($request->Disc);
                $Expenses->date = date('y-m-d');
                $Expenses->year = date('Y');
                $Expenses->create_by  = auth()->user()->name;
                $Expenses->save();
    
                // store fund_accounts
                $fund_accounts = FundAccount::where('expense_id',$Expenses->id)->first();
                $fund_accounts->credit = strip_tags($request->Price);
                $fund_accounts->disc = strip_tags($request->Disc);
                $fund_accounts->date =date('y-m-d');
                $fund_accounts->year = date('Y');
                $fund_accounts->create_by  = auth()->user()->name;
                $fund_accounts->save();

    
    
                toastr()->success('تم تعديل المصروف بنجاح');
                return redirect()->route('Expense.index');
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
            Expense ::destroy(strip_tags($request->id));
            FundAccount ::where('expense_id', strip_tags($request->id))->delete();

            toastr()->error('تم حذف المصروف بنجاح');

            return redirect()->back();
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }
}
