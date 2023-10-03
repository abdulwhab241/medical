<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Invoice;
use App\Models\Patient;
use App\Models\Service;
use App\Models\FundAccount;
use Illuminate\Http\Request;
use App\Models\PatientAccount;
use App\Models\ReceiptAccount;
use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceRequest;

class InvoiceController extends Controller
{
    public function index()
    {
        $Invoices = Invoice::where('year', date('Y'))->get();
        return view('Dashboard.Admin.Cash_Invoice.index', compact('Invoices'));
    }

    public function create()
    {
        $Doctors = User::where('job', 'دكتور')->get();
        $Patients = Patient::all();
        $Services = Service::all();

        return view('Dashboard.Admin.Cash_Invoice.create',compact('Doctors','Services','Patients'));
    }

    public function edit($id)
    {
        $Invoices = Invoice::findOrFail($id);
        $Doctors = User::where('job', 'دكتور')->get();
        $Patients = Patient::all();
        $Services = Service::all();
        return view('Dashboard.Admin.Cash_Invoice.edit', compact('Invoices','Doctors','Patients','Services'));
    }
    

    public function store(InvoiceRequest $request)
    {
// dd($request);

        try{

            
            $total = 0;
            $sub_total =  strip_tags($request->price)  * strip_tags($request->Discount) / 100;
            $total += $sub_total;
            $All =  strip_tags($request->price)  - $sub_total;


            $Disc = Service::where('id',strip_tags($request->Service_id))->pluck('name');

            // store Invoices
            $Invoices = new Invoice();
            $Invoices->invoice_date =date('y-m-d');
            $Invoices->patient_id = strip_tags($request->Patient_id);
            $Invoices->user_doctor_id = strip_tags($request->Doctor_id);
            $Invoices->service_id = strip_tags($request->Service_id);
            $Invoices->price = strip_tags($request->price);
            $Invoices->discount_value = strip_tags($request->Discount);
            $Invoices->total =  $All;
            $Invoices->status = 1;
            $Invoices->year = date('Y');
            $Invoices->create_by  = auth()->user()->name;
            $Invoices->save();

            // store receipt_accounts
            $receipt_accounts = new ReceiptAccount();
            $receipt_accounts->date =date('y-m-d');
            $receipt_accounts->patient_id = strip_tags($request->Patient_id);
            $receipt_accounts->user_doctor_id = strip_tags($request->Doctor_id);
            $receipt_accounts->service_id = strip_tags($request->Service_id);
            $receipt_accounts->amount = $All;
            $receipt_accounts->description = $Disc;
            $receipt_accounts->year = date('Y');
            $receipt_accounts->create_by  = auth()->user()->name;
            $receipt_accounts->save();

            // store fund_accounts
            $fund_accounts = new FundAccount();
            $fund_accounts->receipt_id = $receipt_accounts->id;
            $fund_accounts->Debit = $All;
            $fund_accounts->disc = $Disc;
            $fund_accounts->date =date('y-m-d');
            $fund_accounts->year = date('Y');
            $fund_accounts->create_by  = auth()->user()->name;
            $fund_accounts->save();

            // store patient_accounts
            $patient_accounts = new PatientAccount();
            $patient_accounts->date =date('y-m-d');
            $patient_accounts->patient_id = strip_tags($request->Patient_id);
            $patient_accounts->invoice_id = $Invoices->id;
            $patient_accounts->credit = $All;
            $fund_accounts->create_by  = auth()->user()->name;
            $patient_accounts->save();


            toastr()->success('تم إضافة الفاتورة بنجاح');
            return redirect()->route('CashInvoices.create');
        }

        catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function update(Request $request)
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
            $receipt_accounts->description = $Disc;
            $receipt_accounts->year = date('Y');
            $receipt_accounts->create_by  = auth()->user()->name;
            $receipt_accounts->save();

            // Update fund_accounts
            $fund_accounts = FundAccount::where('receipt_id',$receipt_accounts->id)->first();
            // $fund_accounts->receipt_id = $receipt_accounts->id;
            $fund_accounts->Debit = $All;
            $fund_accounts->disc = $Disc;
            $fund_accounts->date =date('y-m-d');
            $fund_accounts->year = date('Y');
            $fund_accounts->create_by  = auth()->user()->name;
            $fund_accounts->save();

            // Update patient_accounts
            $patient_accounts = PatientAccount::where('invoice_id',strip_tags($request->id))->first();
            $patient_accounts->date =date('y-m-d');
            $patient_accounts->credit = $All;
            $fund_accounts->create_by  = auth()->user()->name;
            $patient_accounts->save();

            toastr()->success('تم تعديل الفاتورة بنجاح');
            return redirect()->route('CashInvoices.index');
        }
        
        catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function destroy(Request $request)
    {
        PatientAccount ::where('invoice_id', strip_tags($request->id))->delete();
        ReceiptAccount ::destroy(strip_tags($request->id));
        FundAccount ::where('receipt_id', strip_tags($request->id))->delete();
        Invoice ::destroy(strip_tags($request->id));
        toastr()->error('تم حذف الفاتورة بنجاح');
        return redirect()->back();
    }


}
