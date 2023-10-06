<?php

namespace App\Http\Controllers\Admin;

use App\Models\Patient;
use App\Models\FundAccount;
use Illuminate\Http\Request;
use App\Models\PatientAccount;
use App\Models\PaymentAccount;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\PaymentRequest;

class PaymentController extends Controller
{
    public function index()
    {
        if(Auth::user()->job == 'admin')
        {
            $payments =  PaymentAccount::all();
            return view('Dashboard.Admin.Payment.index',compact('payments'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }

    public function create()
    {
        if(Auth::user()->job == 'admin')
        {
            $Patients = Patient::all();
            return view('Dashboard.Admin.Payment.add',compact('Patients'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }

    public function edit($id)
    {
        if(Auth::user()->job == 'admin')
        {
            $payment_accounts = PaymentAccount::findOrFail($id);
            return view('Dashboard.Admin.Payment.edit',compact('payment_accounts'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }

    public function show($id)
    {
        if(Auth::user()->job == 'admin')
        {
            $payment_account = PaymentAccount::findOrFail($id);
            return view('Dashboard.Admin.Payment.print',compact('payment_account'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }

    public function store(PaymentRequest $request)
    {

        if(Auth::user()->job == 'admin')
        {

            try{
                $Checks = PatientAccount::where('patient_id',strip_tags($request->Patient_id))
                ->where('credit', strip_tags($request->price))->where('year', date('Y'))->pluck('credit');
    
                if($Checks->count() == 0)
                {
                    toastr()->info('عذراً لا يمكنك إضافة سند الصرف لهذا المريض بسبب عدم وجود اي مبلغ مطابق لمبلغ المريض في حسابه !!');
                    return redirect()->back();
                }
    
                // store Payments
                $Payments = new PaymentAccount();
                $Payments->patient_id = strip_tags($request->Patient_id);
                $Payments->description = strip_tags($request->Disc);
                $Payments->amount = strip_tags($request->price);
                $Payments->date = date('y-m-d');
                $Payments->year = date('Y');
                $Payments->create_by  = auth()->user()->name;
                $Payments->save();
    
                // store fund_accounts
                $fund_accounts = new FundAccount();
                $fund_accounts->payment_id = $Payments->id;
                $fund_accounts->patient_id = strip_tags($request->Patient_id);
                $fund_accounts->credit = strip_tags($request->price);
                $fund_accounts->disc = strip_tags($request->Disc);
                $fund_accounts->date =date('y-m-d');
                $fund_accounts->year = date('Y');
                $fund_accounts->create_by  = auth()->user()->name;
                $fund_accounts->save();
    
                // store patient_accounts
                $patient_accounts = new PatientAccount();
                $patient_accounts->patient_id = strip_tags($request->Patient_id);
                $patient_accounts->payment_id = $Payments->id;
                $patient_accounts->Debit = strip_tags($request->price);
                $patient_accounts->date =date('y-m-d');
                $patient_accounts->year =date('Y');
                $patient_accounts->create_by  = auth()->user()->name;
                $patient_accounts->save();
    
    
                toastr()->success('تم إضافة سند الصرف بنجاح');
                return redirect()->route('Payment.index');
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
            // $Checks = PatientAccount::where('patient_id',strip_tags($request->Patient_id))
            // ->where('credit', strip_tags($request->price))->where('year', date('Y'))->pluck('credit');

            // if($Checks->count() == 0)
            // {
            //     toastr()->info('عذراً لا يمكنك تعديل سند الصرف لهذا المريض بسبب عدم وجود اي مبلغ مطابق لمبلغ المريض في حسابه !!');
            //     return redirect()->back();
            // }

                // update Payments
            $Payments = PaymentAccount::findOrFail(strip_tags($request->id));
            $Payments->patient_id = strip_tags($request->Patient_id);
            $Payments->description = strip_tags($request->Disc);
            $Payments->amount = strip_tags($request->price);
            $Payments->date = date('y-m-d');
            $Payments->year = date('Y');
            $Payments->create_by  = auth()->user()->name;
            $Payments->save();

                // update fund_accounts
            $fund_accounts = FundAccount::where('payment_id',strip_tags($request->id))->first();
            $fund_accounts->patient_id = strip_tags($request->Patient_id);
            $fund_accounts->credit = strip_tags($request->price);
            $fund_accounts->disc = strip_tags($request->Disc);
            $fund_accounts->date =date('y-m-d');
            $fund_accounts->year = date('Y');
            $fund_accounts->create_by  = auth()->user()->name;
            $fund_accounts->save();

                // update patient_accounts
            $patient_accounts = PatientAccount::where('payment_id',strip_tags($request->id))->first();
            $patient_accounts->patient_id = strip_tags($request->Patient_id);
            $patient_accounts->Debit = strip_tags($request->price);
            $patient_accounts->date =date('y-m-d');
            $patient_accounts->year =date('Y');
            $patient_accounts->create_by  = auth()->user()->name;
            $patient_accounts->save();
    
            toastr()->success('تم تعديل سند الصرف بنجاح');
            return redirect()->route('Payment.index');
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        if(Auth::user()->job == 'admin')
        {
            PatientAccount ::where('payment_id', strip_tags($request->id))->delete();
            PaymentAccount ::destroy(strip_tags($request->id));
            FundAccount ::where('payment_id', strip_tags($request->id))->delete();

            toastr()->error('تم حذف سند الصرف بنجاح');
            return redirect()->back();
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }
}
