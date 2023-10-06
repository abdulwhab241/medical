<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Patient;
use App\Models\Service;
use App\Models\Insurance;
use App\Models\FundAccount;
use Illuminate\Http\Request;
use App\Models\PatientAccount;
use App\Models\InsuranceDetails;
use App\Models\InsuranceInvoice;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\InsuranceInvoiceRequest;

class InsuranceInvoiceController extends Controller
{
    public function index()
    {
        if(Auth::user()->job == 'admin')
        {
            $Insurances = InsuranceInvoice::all();
            return view('Dashboard.Admin.Insurance_Invoice.index', compact('Insurances'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }

    public function create()
    {
        if(Auth::user()->job == 'admin')
        {
            $Companies = Insurance::where('year', date('Y'))->get();
            $Doctors = User::where('job', 'دكتور')->get();
            $Patients = Patient::all();
            $Services = Service::all();
    
            return view('Dashboard.Admin.Insurance_Invoice.create',compact('Doctors','Services','Patients','Companies'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }

    public function edit($id)
    {
        if(Auth::user()->job == 'admin')
        {
            $Companies = Insurance::where('year', date('Y'))->get();
            $Invoices = InsuranceInvoice::findOrFail($id);
            $Doctors = User::where('job', 'دكتور')->get();
            $Patients = Patient::all();
            $Services = Service::all();

            return view('Dashboard.Admin.Insurance_Invoice.edit', compact('Invoices','Companies','Doctors','Patients','Services'));    
        }

        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }

    public function show($id)
    {
        if(Auth::user()->job == 'admin')
        {
            $Invoice = InsuranceInvoice::findOrFail($id);

            return view('Dashboard.Admin.Insurance_Invoice.print', compact('Invoice'));    
        }

        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }

    public function store(InsuranceInvoiceRequest $request)
    {
        if(Auth::user()->job == 'admin')
        {
            try
            {

                $Company_rat = InsuranceDetails::where('insurance_id',strip_tags($request->Company_id))
                ->where('name', strip_tags($request->Employee))->pluck('company_rate');

                $Patient_discount = InsuranceDetails::where('insurance_id',strip_tags($request->Company_id))
                ->where('name', strip_tags($request->Employee))->pluck('discount_percentage');
        
                $Disc = Service::where('id',strip_tags($request->Service_id))->pluck('name');

                // store InsuranceInvoice
                $InsuranceInvoice = new InsuranceInvoice();
                $InsuranceInvoice->insurance_id = strip_tags($request->Company_id);
                $InsuranceInvoice->subscriber_number = strip_tags($request->Number);
                $InsuranceInvoice->subscriber_gender = strip_tags($request->Employee);
                $InsuranceInvoice->patient_id = strip_tags($request->Patient_id);
                $InsuranceInvoice->user_doctor_id = strip_tags($request->Doctor_id);
                $InsuranceInvoice->service_id = strip_tags($request->Service_id);
                $InsuranceInvoice->price = strip_tags($request->price);

                foreach($Patient_discount as $discount)
                {
                    $total = 0;
                    $sub_total =  strip_tags($request->price)  * $discount / 100;
                    $total += $sub_total;
                    $InsuranceInvoice->discount_percentage = $discount;  //نسبة تحمل المريض
                    $InsuranceInvoice->total_patient = $total; // مجموع المريض
                }

                foreach($Company_rat as $Company)
                {
                    $InsuranceInvoice->company_rate = $Company;  // نسبة تحمل الشركة
                }

                $InsuranceInvoice->total_invoice = strip_tags($request->price);  // مجموع الفاتورة

                $InsuranceInvoice->status = 1;
                $InsuranceInvoice->date =date('y-m-d');
                $InsuranceInvoice->year = date('Y');
                $InsuranceInvoice->create_by  = auth()->user()->name;
                $InsuranceInvoice->save();
    
    
                // store fund_accounts
                $fund_accounts = new FundAccount();
                $fund_accounts->insurance_id = $InsuranceInvoice->id;
                $fund_accounts->patient_id = strip_tags($request->Patient_id);
                $fund_accounts->credit = strip_tags($request->price);

                foreach($Disc as $D)
                {
                    $fund_accounts->disc = $D;
                }

                $fund_accounts->date =date('y-m-d');
                $fund_accounts->year = date('Y');
                $fund_accounts->create_by  = auth()->user()->name;
                $fund_accounts->save();
    
                // store patient_accounts
                $patient_accounts = new PatientAccount();
                $patient_accounts->date =date('y-m-d');
                $patient_accounts->patient_id = strip_tags($request->Patient_id);
                $patient_accounts->insurance_invoice_id = $InsuranceInvoice->id;

                foreach($Patient_discount as $discount)
                {
                    $total = 0;
                    $sub_total =  strip_tags($request->price)  * $discount / 100;
                    $total += $sub_total;
                    $patient_accounts->credit = $total; // مجموع المريض
                }

                $fund_accounts->create_by  = auth()->user()->name;
                $patient_accounts->save();
    
    
                toastr()->success('تم إضافة فاتورة التأمين بنجاح');
                return redirect()->route('InsuranceInvoice.create');

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
            try
            {

                $Company_rat = InsuranceDetails::where('insurance_id',strip_tags($request->Company_id))
                ->where('name', strip_tags($request->Employee))->pluck('company_rate');

                $Patient_discount = InsuranceDetails::where('insurance_id',strip_tags($request->Company_id))
                ->where('name', strip_tags($request->Employee))->pluck('discount_percentage');
        
                $Disc = Service::where('id',strip_tags($request->Service_id))->pluck('name');

                // store InsuranceInvoice
                $InsuranceInvoice = InsuranceInvoice::findOrFail(strip_tags($request->id));
                $InsuranceInvoice->insurance_id = strip_tags($request->Company_id);
                $InsuranceInvoice->subscriber_number = strip_tags($request->Number);
                $InsuranceInvoice->subscriber_gender = strip_tags($request->Employee);
                $InsuranceInvoice->patient_id = strip_tags($request->Patient_id);
                $InsuranceInvoice->user_doctor_id = strip_tags($request->Doctor_id);
                $InsuranceInvoice->service_id = strip_tags($request->Service_id);
                $InsuranceInvoice->price = strip_tags($request->price);

                foreach($Patient_discount as $discount)
                {
                    $total = 0;
                    $sub_total =  strip_tags($request->price)  * $discount / 100;
                    $total += $sub_total;
                    $InsuranceInvoice->discount_percentage = $discount;  //نسبة تحمل المريض
                    $InsuranceInvoice->total_patient = $total; // مجموع المريض
                }

                foreach($Company_rat as $Company)
                {
                    $InsuranceInvoice->company_rate = $Company;  // نسبة تحمل الشركة
                }

                $InsuranceInvoice->total_invoice = strip_tags($request->price);  // مجموع الفاتورة

                $InsuranceInvoice->status = 1;
                $InsuranceInvoice->date =date('y-m-d');
                $InsuranceInvoice->year = date('Y');
                $InsuranceInvoice->create_by  = auth()->user()->name;
                $InsuranceInvoice->save();
    
    
                // store fund_accounts
                $fund_accounts = FundAccount::where('insurance_id',strip_tags($request->id))->first();
                // $fund_accounts->insurance_id = $InsuranceInvoice->id;
                $fund_accounts->patient_id = strip_tags($request->Patient_id);
                $fund_accounts->credit = strip_tags($request->price);

                foreach($Disc as $D)
                {
                    $fund_accounts->disc = $D;
                }

                $fund_accounts->date =date('y-m-d');
                $fund_accounts->year = date('Y');
                $fund_accounts->create_by  = auth()->user()->name;
                $fund_accounts->save();
    
                // store patient_accounts
                $patient_accounts = PatientAccount::where('insurance_invoice_id',strip_tags($request->id))->first();
                $patient_accounts->date =date('y-m-d');
                $patient_accounts->patient_id = strip_tags($request->Patient_id);

                foreach($Patient_discount as $discount)
                {
                    $total = 0;
                    $sub_total =  strip_tags($request->price)  * $discount / 100;
                    $total += $sub_total;
                    $patient_accounts->credit = $total; // مجموع المريض
                }
                $patient_accounts->year =date('Y');
                $patient_accounts->create_by  = auth()->user()->name;
                $patient_accounts->save();
    
    
                toastr()->success('تم تعديل فاتورة التأمين بنجاح');
                return redirect()->route('InsuranceInvoice.index');

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
            PatientAccount ::where('insurance_invoice_id', strip_tags($request->id))->delete();
            InsuranceInvoice ::destroy(strip_tags($request->id));
            FundAccount ::where('insurance_id', strip_tags($request->id))->delete();
            toastr()->error('تم حذف فاتورة التأمين بنجاح');
            return redirect()->back();
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }
}
