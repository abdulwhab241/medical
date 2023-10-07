<?php

namespace App\Http\Controllers\Admin;

use App\Models\Medicine;
use App\Models\FundAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\MedicineRequest;

class MedicineController extends Controller
{
    public function index()
    {
        if(Auth::user()->job == 'admin')
        {
            $Medicines =  Medicine::all();
            return view('Dashboard.Admin.Medicines.index',compact('Medicines'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }

    public function create()
    {
        if(Auth::user()->job == 'admin')
        {
            return view('Dashboard.Admin.Medicines.create');
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();

    }

    public function edit($id)
    {
        if(Auth::user()->job == 'admin')
        {
            $Medicine = Medicine::findOrFail($id);
            return view('Dashboard.Admin.Medicines.edit',compact('Medicine'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }

    public function print()
    {
        if(Auth::user()->job == 'admin')
        {
            $Medicines = Medicine::all();
            return view('Dashboard.Admin.Medicines.print',compact('Medicines'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }

    public function store(MedicineRequest $request)
    {
        if(Auth::user()->job == 'admin')
        {
            // dd($request);
            try {

                $total = 0;
                $sub_total = strip_tags($request->Buy_Price) * strip_tags($request->Quantity);
                $total = $sub_total;
                // $All = $sub_total - strip_tags($request->Discount);

                // store Medicine
                $Medicines = new Medicine();
                $Medicines->name = strip_tags($request->Name);
                $Medicines->bar_code = strip_tags($request->Bar_Code);
                $Medicines->supplier =strip_tags($request->Supplier);
                $Medicines->unit = strip_tags($request->Unit);
                $Medicines->quantity = strip_tags($request->Quantity);
                $Medicines->buy_price = strip_tags($request->Buy_Price);
                $Medicines->sale_price = strip_tags($request->Sale_Price);
                $Medicines->end_date = strip_tags($request->End_Date);
                $Medicines->total = $total;
                $Medicines->date = date('Y-m-d');
                $Medicines->year = date('Y');
                $Medicines->create_by  = auth()->user()->name;
                $Medicines->save();

                // store fund_accounts
                $fund_accounts = new FundAccount();
                $fund_accounts->medicine_id = $Medicines->id;
                $fund_accounts->credit =  $total;
                $fund_accounts->disc = 'شراء ادوية';
                $fund_accounts->date =date('y-m-d');
                $fund_accounts->year = date('Y');
                $fund_accounts->create_by  = auth()->user()->name;
                $fund_accounts->save();
    
                toastr()->success('تم إضافة بيانات الأدوية بنجاح');
                return redirect()->back();
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
            // dd($request);
            try {

                $total = 0;
                $sub_total = strip_tags($request->Buy_Price) * strip_tags($request->Quantity);
                $total = $sub_total;
                // $All = $sub_total - strip_tags($request->Discount);

                // update Medicine
                $Medicines = Medicine::findOrFail(strip_tags($request->id));
                $Medicines->name = strip_tags($request->Name);
                $Medicines->bar_code = strip_tags($request->Bar_Code);
                $Medicines->supplier =strip_tags($request->Supplier);
                $Medicines->unit = strip_tags($request->Unit);
                $Medicines->quantity = strip_tags($request->Quantity);
                $Medicines->buy_price = strip_tags($request->Buy_Price);
                $Medicines->sale_price = strip_tags($request->Sale_Price);
                $Medicines->end_date = strip_tags($request->End_Date);
                $Medicines->total = $total;
                $Medicines->date = date('Y-m-d');
                $Medicines->year = date('Y');
                $Medicines->create_by  = auth()->user()->name;
                $Medicines->save();

                // update fund_accounts
                $fund_accounts = FundAccount::where('medicine_id',strip_tags($request->id))->first();
                $fund_accounts->credit =  $total;
                $fund_accounts->disc = 'تعديل شراء ادوية';
                $fund_accounts->date =date('y-m-d');
                $fund_accounts->year = date('Y');
                $fund_accounts->create_by  = auth()->user()->name;
                $fund_accounts->save();
    
                toastr()->success('تم تعديل بيانات الأدوية بنجاح');
                return redirect()->route('Medicine.index');

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
            Medicine ::destroy(strip_tags($request->id));
            FundAccount ::where('medicine_id', strip_tags($request->id))->delete();
            toastr()->error('تم حذف بيانات الأدوية بنجاح');
            return redirect()->back();
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }
}
