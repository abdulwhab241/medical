<?php

namespace App\Http\Controllers\Admin;

use App\Models\Patient;
use App\Models\FundAccount;
use Illuminate\Http\Request;
use App\Models\PatientAccount;
use App\Models\ReceiptAccount;
use App\Http\Controllers\Controller;

class ReceiptController extends Controller
{
    public function index()
    {
        $receipts =  ReceiptAccount::all();
        return view('Dashboard.Admin.Receipt.index',compact('receipts'));
    }

    public function create()
    {
        $Patients = Patient::all();
        return view('Dashboard.Admin.Receipt.add',compact('Patients'));
    }

    public function edit($id)
    {
        $receipt_accounts = ReceiptAccount::findOrFail($id);
        $Patients = Patient::all();
        return view('Dashboard.Admin.Receipt.edit',compact('receipt_accounts','Patients'));
    }

    public function show($id)
    {
        $receipt = ReceiptAccount::findOrFail($id);
        return view('Dashboard.Admin.Receipt.print',compact('receipt'));
    }

    public function store(Request $request)
    {


        try{
            // store receipt_accounts
            $receipt_accounts = new ReceiptAccount();
            $receipt_accounts->date =date('y-m-d');
            $receipt_accounts->patient_id = $request->patient_id;
            $receipt_accounts->amount = $request->Debit;
            $receipt_accounts->description = $request->description;
            $receipt_accounts->save();
            // store fund_accounts
            $fund_accounts = new FundAccount();
            $fund_accounts->date =date('y-m-d');
            $fund_accounts->receipt_id = $receipt_accounts->id;
            $fund_accounts->Debit = $request->Debit;
            $fund_accounts->credit = 0.00;
            $fund_accounts->save();
            // store patient_accounts
            $patient_accounts = new PatientAccount();
            $patient_accounts->date =date('y-m-d');
            $patient_accounts->patient_id = $request->patient_id;
            $patient_accounts->receipt_id = $receipt_accounts->id;
            $patient_accounts->Debit = 0.00;
            $patient_accounts->credit =$request->Debit;
            $patient_accounts->save();


            toastr()->success('تم إضافة الفاتورة بنجاح');
            return redirect()->route('Receipt.create');
        }

        catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


}
