<?php

namespace App\Http\Controllers\Admin;

use App\Models\Patient;
use App\Models\FundAccount;
use Illuminate\Http\Request;
use App\Models\PatientAccount;
use App\Models\ReceiptAccount;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReceiptController extends Controller
{
    public function index()
    {
        if(Auth::user()->job == 'admin')
        {
            $receipts =  ReceiptAccount::all();
            return view('Dashboard.Admin.Receipt.index',compact('receipts'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();

    }

    public function show($id)
    {
        if(Auth::user()->job == 'admin')
        {
            $receipt = ReceiptAccount::findOrFail($id);
            return view('Dashboard.Admin.Receipt.print',compact('receipt'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }

    // public function store(Request $request)
    // {


    //     try{
    //         // store receipt_accounts
    //         $receipt_accounts = new ReceiptAccount();
    //         $receipt_accounts->date =date('y-m-d');
    //         $receipt_accounts->patient_id = $request->patient_id;
    //         $receipt_accounts->amount = $request->Debit;
    //         $receipt_accounts->description = $request->description;
    //         $receipt_accounts->save();
    //         // store fund_accounts
    //         $fund_accounts = new FundAccount();
    //         $fund_accounts->date =date('y-m-d');
    //         $fund_accounts->receipt_id = $receipt_accounts->id;
    //         $fund_accounts->Debit = $request->Debit;
    //         $fund_accounts->credit = 0.00;
    //         $fund_accounts->save();
    //         // store patient_accounts
    //         $patient_accounts = new PatientAccount();
    //         $patient_accounts->date =date('y-m-d');
    //         $patient_accounts->patient_id = $request->patient_id;
    //         $patient_accounts->receipt_id = $receipt_accounts->id;
    //         $patient_accounts->Debit = 0.00;
    //         $patient_accounts->credit =$request->Debit;
    //         $patient_accounts->save();


    //         toastr()->success('تم إضافة الفاتورة بنجاح');
    //         return redirect()->route('Receipt.create');
    //     }

    //     catch (\Exception $e) {

    //         return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    //     }

    // }


}
