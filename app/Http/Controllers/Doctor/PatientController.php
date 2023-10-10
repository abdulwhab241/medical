<?php

namespace App\Http\Controllers\Doctor;

use App\Models\Invoice;
use App\Models\Service;
use App\Models\Medicine;
use App\Models\PatientRay;
use App\Models\RayService;
use Illuminate\Http\Request;
use App\Models\PatientAccount;
use App\Models\InsuranceInvoice;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{

    public function patient_cash()
    {
        if(Auth::user()->job == 'دكتور')
        {
            $Invoices =  Invoice::where('user_doctor_id', auth()->user()->id)->where('invoice_date', date('y-m-d'))->get();
            $Rays = RayService::all();
            return view('Dashboard.Dashboard_Doctors.Patient_Doctors.patient-cash',compact('Invoices','Rays'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }

    public function patient_insurance()
    {
        if(Auth::user()->job == 'دكتور')
        {

            $Invoices =  InsuranceInvoice::where('user_doctor_id', auth()->user()->id)->where('date', date('y-m-d'))->get();
            return view('Dashboard.Dashboard_Doctors.Patient_Doctors.patient-insurance',compact('Invoices'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }

    public function edit($id)
    {
        if(Auth::user()->job == 'دكتور')
        {
            $Invoice = Invoice::findOrFail($id);
            $Medicines = Medicine::all();

            return view('Dashboard.Dashboard_Doctors.Patient_Medicines.create',compact('Invoice','Medicines'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }

    
    public function all()
    {
        if(Auth::user()->job == 'دكتور')
        {
            $Patients = PatientAccount::distinct()->where('user_doctor_id', auth()->user()->id)->get(['patient_id']);

            return view('Dashboard.Dashboard_Doctors.Patient_Doctors.all_patients',compact('Patients'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }

    public function show_patient($id)
    {
        if(Auth::user()->job == 'دكتور')
        {
            $Patients = PatientAccount::distinct()->where('user_doctor_id', auth()->user()->id)->get(['patient_id']);

            return view('Dashboard.Dashboard_Doctors.Patient_Doctors.show_patient',compact('Patients'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }

}
