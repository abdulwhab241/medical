<?php

namespace App\Http\Controllers\Doctor;

use App\Models\Medicine;
use App\Models\Diagnostic;
use Illuminate\Http\Request;
use App\Models\PatientAccount;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DiagnosticController extends Controller
{
    public function index()
    {
        if(Auth::user()->job == 'دكتور')
        {
            $Diagnostics =  Diagnostic::all();
            return view('Dashboard.Dashboard_Doctors.Diagnostics.index',compact('Diagnostics'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }


    public function store(Request $request)
    {
        if(Auth::user()->job == 'دكتور')
        {
            try{

                  // store Diagnostics
                $Diagnostics = new Diagnostic();
                $Diagnostics->invoice_id = strip_tags($request->Invoice_id);
                $Diagnostics->patient_id = strip_tags($request->Patient_id);
                $Diagnostics->user_doctor_id = auth()->user()->id;
                $Diagnostics->diagnosis = strip_tags($request->Diagnosis);
                $Diagnostics->date =date('y-m-d');
                $Diagnostics->year =date('Y');
                $Diagnostics->create_by = auth()->user()->name;
                $Diagnostics->save();


                 // store patient_accounts
                $patient_accounts = new PatientAccount();
                $patient_accounts->patient_id = strip_tags($request->Patient_id);
                $patient_accounts->invoice_id = strip_tags($request->Invoice_id);
                $patient_accounts->user_doctor_id = auth()->user()->id;
                $patient_accounts->diagnostic_id = $Diagnostics->id;
                $patient_accounts->date =date('y-m-d');
                $patient_accounts->year =date('Y');
                $patient_accounts->create_by  = auth()->user()->name;
                $patient_accounts->save();
                toastr()->success('تم إضافة تشخيص المريض بنجاح');
                return redirect()->back();


            }
            
            catch (\Exception $e) {
    
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }

    public function update(Request $request)
    {
        if(Auth::user()->job == 'دكتور')
        {
            try{

                // update Diagnostics
                $Diagnostics = Diagnostic::findOrFail(strip_tags($request->id));
                $Diagnostics->invoice_id = strip_tags($request->Invoice_id);
                $Diagnostics->patient_id = strip_tags($request->Patient_id);
                $Diagnostics->user_doctor_id = auth()->user()->id;
                $Diagnostics->diagnosis = strip_tags($request->Diagnosis);
                $Diagnostics->date =date('y-m-d');
                $Diagnostics->year =date('Y');
                $Diagnostics->create_by = auth()->user()->name;
                $Diagnostics->save();


                // update patient_accounts
                $patient_accounts = PatientAccount::where('diagnostic_id',strip_tags($request->id))->first();
                $patient_accounts->patient_id = strip_tags($request->Patient_id);
                $patient_accounts->invoice_id = strip_tags($request->Invoice_id);
                $patient_accounts->user_doctor_id = auth()->user()->id;
                $patient_accounts->date =date('y-m-d');
                $patient_accounts->year =date('Y');
                $patient_accounts->create_by  = auth()->user()->name;
                $patient_accounts->save();
                toastr()->success('تم تعديل تشخيص المريض بنجاح');
                return redirect()->back();
    

            }
            
            catch (\Exception $e) {
    
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        if(Auth::user()->job == 'دكتور')
        {
            PatientAccount::where('diagnostic_id', strip_tags($request->id))->delete();
            Diagnostic::destroy(strip_tags($request->id));

            toastr()->error('تم حذف تشخيص المريض بنجاح');
            return redirect()->back();
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }
}
