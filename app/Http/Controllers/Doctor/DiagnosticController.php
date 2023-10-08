<?php

namespace App\Http\Controllers\Doctor;

use App\Models\Medicine;
use App\Models\Diagnostic;
use Illuminate\Http\Request;
use App\Models\PatientAccount;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Doctor\DiagnosticRequest;

class DiagnosticController extends Controller
{
    public function index()
    {
        if(Auth::user()->job == 'دكتور')
        {
            $Diagnostics =  Diagnostic::all();
            // $Medicines = Medicine::all();
            return view('Dashboard.Dashboard_Doctors.Diagnostics.index',compact('Diagnostics'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }

    public function store(Request $request)
    {
        if(Auth::user()->job == 'دكتور')
        {
            dd($request);
            try{
                // store Diagnostics
                $Diagnostics = new Diagnostic();
                $Diagnostics->invoice_id = strip_tags($request->id);
                $Diagnostics->patient_id = strip_tags($request->Patient_id);
                $Diagnostics->user_doctor_id = auth()->user()->id;
                $Diagnostics->diagnosis = strip_tags($request->Diagnosis);
                $Diagnostics->medicine_id = strip_tags($request->Medicine_id);
                $Diagnostics->dosage = strip_tags($request->Dosage);
                $Diagnostics->use =  strip_tags($request->Use);
                $Diagnostics->period = strip_tags($request->Period);
                $Diagnostics->date =date('y-m-d');
                $Diagnostics->year = date('Y');
                $Diagnostics->create_by  = auth()->user()->name;
                $Diagnostics->save();
    
    
                // store patient_accounts
                $patient_accounts = new PatientAccount();
                $patient_accounts->date =date('y-m-d');
                $patient_accounts->patient_id = strip_tags($request->Patient_id);
                $patient_accounts->invoice_id = strip_tags($request->id);
                $patient_accounts->diagnostic_id = $Diagnostics->id;
                $patient_accounts->year =date('Y');
                $patient_accounts->create_by  = auth()->user()->name;
                $patient_accounts->save();
    
    
                toastr()->success('تم إضافة تشخيص المريض بنجاح');
                return redirect()->route('patient_cash');
    

            }
            
            catch (\Exception $e) {
    
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }
}
