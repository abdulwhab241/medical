<?php

namespace App\Http\Controllers\Doctor;

use App\Models\Medicine;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DiagnosticController extends Controller
{
    public function store(Request $request)
    {
        if(Auth::user()->job == 'دكتور')
        {
            try{
                $total = 0;
                $sub_total =  strip_tags($request->price)  * strip_tags($request->Discount) / 100;
                $total += $sub_total;
                $All =  strip_tags($request->price)  - $sub_total;
    
                $Disc = Service::where('id',strip_tags($request->Service_id))->pluck('name');
    
                // Update Invoices
                $Invoices = Invoice::findOrFail(strip_tags($request->id));
                $Invoices->invoice_date =date('y-m-d');
                $Invoices->user_doctor_id = strip_tags($request->Doctor_id);
                $Invoices->service_id = strip_tags($request->Service_id);
                $Invoices->price = strip_tags($request->price);
                $Invoices->discount_value = strip_tags($request->Discount);
                $Invoices->total =  $All;
                $Invoices->status = 1;
                $Invoices->year = date('Y');
                $Invoices->create_by  = auth()->user()->name;
                $Invoices->save();
    
                // Update receipt_accounts
                $receipt_accounts = ReceiptAccount::findOrFail(strip_tags($request->id));
                $receipt_accounts->date =date('y-m-d');
                $receipt_accounts->user_doctor_id = strip_tags($request->Doctor_id);
                $receipt_accounts->service_id = strip_tags($request->Service_id);
                $receipt_accounts->amount = $All;

                $receipt_accounts->year = date('Y');
                $receipt_accounts->create_by  = auth()->user()->name;
                $receipt_accounts->save();
    
                // Update fund_accounts
                $fund_accounts = FundAccount::where('receipt_id',$receipt_accounts->id)->first();
                // $fund_accounts->receipt_id = $receipt_accounts->id;
                $fund_accounts->Debit = $All;

                foreach($Disc as $D)
                {
                    $fund_accounts->disc = $D;
                }

                // $fund_accounts->disc = $Disc;
                $fund_accounts->date =date('y-m-d');
                $fund_accounts->year = date('Y');
                $fund_accounts->create_by  = auth()->user()->name;
                $fund_accounts->save();
    
                // Update patient_accounts
                $patient_accounts = PatientAccount::where('invoice_id',strip_tags($request->id))->first();
                $patient_accounts->date =date('y-m-d');
                $patient_accounts->credit = $All;
                $patient_accounts->year =date('Y');
                $patient_accounts->create_by  = auth()->user()->name;
                $patient_accounts->save();
    
                toastr()->success('تم تعديل الفاتورة بنجاح');
                return redirect()->route('CashInvoices.index');
            }
            
            catch (\Exception $e) {
    
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }
}
