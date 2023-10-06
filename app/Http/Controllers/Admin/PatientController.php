<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gender;
use App\Models\Invoice;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Models\PatientAccount;
use App\Models\ReceiptAccount;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\PatientRequest;

class PatientController extends Controller
{
    public function index()
    {
        if(Auth::user()->job == 'admin')
        {
            $Patients = Patient::all();
            return view('Dashboard.Admin.Patients.index',compact('Patients'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();

    }

    public function Show($id)
    {
        if(Auth::user()->job == 'admin')
        {
            $Patient = patient::findOrFail($id);
            $invoices = Invoice::where('patient_id', $id)->get();
            $receipt_accounts = ReceiptAccount::where('patient_id', $id)->get();
            $Patient_accounts = PatientAccount::where('patient_id', $id)->get();
    
            return view('Dashboard.Admin.Patients.show', compact('Patient', 'invoices', 'receipt_accounts', 'Patient_accounts'));
    
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }

    public function create()
    {
        if(Auth::user()->job == 'admin')
        {
            $Genders = Gender::all();
            return view('Dashboard.Admin.Patients.create',compact('Genders'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();

    }

    public function edit($id)
    {
        if(Auth::user()->job == 'admin')
        {
            $Patient = Patient::findOrFail($id);
            $Genders = Gender::all();
            return view('Dashboard.Admin.Patients.edit',compact('Patient','Genders'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();

    }

    public function store(PatientRequest $request)
    {
        if(Auth::user()->job == 'admin')
        {
            try {
                $Patients = new Patient();
                $Patients->name = strip_tags($request->Name);
                $Patients->address = strip_tags($request->Address);
                $Patients->password = Hash::make(strip_tags($request->Phone));
                $Patients->age = strip_tags($request->Age);
                $Patients->phone = strip_tags($request->Phone);
                $Patients->gender_id = strip_tags($request->Gender);
                $Patients->date = date('Y-m-d');
                $Patients->year = date('Y');
                $Patients->create_by  = auth()->user()->name;
                $Patients->save();
    
                toastr()->success('تم إضافة بيانات المريض بنجاح');
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
            $Patient = Patient::findOrFail(strip_tags($request->id));
            $Patient->name = strip_tags($request->Name);
            $Patient->address = strip_tags($request->Address);
            $Patient->password = Hash::make(strip_tags($request->Phone));
            $Patient->age = strip_tags($request->Age);
            $Patient->phone = strip_tags($request->Phone);
            $Patient->gender_id = strip_tags($request->Gender);
            $Patient->date = date('Y-m-d');
            $Patient->year = date('Y');
            $Patient->create_by  = auth()->user()->name;
            $Patient->save();
    
            toastr()->success('تم تعديل بيانات المريض بنجاح');
            return redirect()->route('Patients.index');
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();

    }

    public function destroy(Request $request)
    {
        if(Auth::user()->job == 'admin')
        {
            PatientAccount::destroy(strip_tags($request->id));
            Patient::destroy(strip_tags($request->id));
            toastr()->error('تم حذف بيانات المريض بنجاح');
            return redirect()->back();
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();

    }
}
