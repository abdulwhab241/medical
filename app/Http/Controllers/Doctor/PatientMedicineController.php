<?php

namespace App\Http\Controllers\Doctor;

use App\Models\Medicine;
use Illuminate\Http\Request;
use App\Models\PatientAccount;
use App\Models\PatientMedicine;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Doctor\DiagnosticRequest;

class PatientMedicineController extends Controller
{
    public function index()
    {
        if(Auth::user()->job == 'دكتور')
        {
            $PatientMedicines = PatientMedicine::where('user_doctor_id', auth()->user()->id)->get();

            return view('Dashboard.Dashboard_Doctors.Patient_Medicines.index',compact('PatientMedicines'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }

    public function create()
    {
        if(Auth::user()->job == 'دكتور')
        {
            $Medicines = Medicine::all();

            return view('Dashboard.Dashboard_Doctors.Patient_Medicines.index',compact('Medicines'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }

    public function edit($id)
    {
        if(Auth::user()->job == 'دكتور')
        {
            $PatientMedicine = PatientMedicine::findOrFail($id);
            $Medicines = Medicine::all();

            if($PatientMedicine->user_doctor_id !=auth()->user()->id){
                return redirect()->back();
            }

            return view('Dashboard.Dashboard_Doctors.Patient_Medicines.edit',compact('PatientMedicine','Medicines'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }

    public function store(DiagnosticRequest $request)
    {
        if(Auth::user()->job == 'دكتور')
        {
            try{

                $PatientMedicines = new PatientMedicine();
                $PatientMedicines->patient_id = strip_tags($request->Patient_id);
                $PatientMedicines->user_doctor_id = auth()->user()->id;
                $PatientMedicines->medicine_id = strip_tags($request->Medicine_id);
                $PatientMedicines->dosage = strip_tags($request->Dosage);
                $PatientMedicines->use = strip_tags($request->Use);
                $PatientMedicines->period = strip_tags($request->Period);
                $PatientMedicines->date =date('y-m-d');
                $PatientMedicines->year =date('Y');
                $PatientMedicines->create_by = auth()->user()->name;
                $PatientMedicines->save();


                $patient_accounts = new PatientAccount();
                $patient_accounts->patient_id = strip_tags($request->Patient_id);
                $patient_accounts->medicine_id = $PatientMedicines->id;
                $patient_accounts->date =date('y-m-d');
                $patient_accounts->year =date('Y');
                $patient_accounts->create_by = auth()->user()->name;
                $patient_accounts->save();


                toastr()->success('تم إضافة دواء المريض بنجاح');
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
        if(Auth::user()->job == 'دكتور')
        {
            try{

                $PatientMedicines = PatientMedicine::findOrFail(strip_tags($request->id));
                $PatientMedicines->patient_id = strip_tags($request->Patient_id);
                $PatientMedicines->user_doctor_id = auth()->user()->id;
                $PatientMedicines->medicine_id = strip_tags($request->Medicine_id);
                $PatientMedicines->dosage = strip_tags($request->Dosage);
                $PatientMedicines->use = strip_tags($request->Use);
                $PatientMedicines->period = strip_tags($request->Period);
                $PatientMedicines->date =date('y-m-d');
                $PatientMedicines->year =date('Y');
                $PatientMedicines->create_by = auth()->user()->name;
                $PatientMedicines->save();


                $patient_accounts = PatientAccount::where('medicine_id',strip_tags($request->id))->first();
                $patient_accounts->patient_id = strip_tags($request->Patient_id);
                $patient_accounts->date =date('y-m-d');
                $patient_accounts->year =date('Y');
                $patient_accounts->create_by = auth()->user()->name;
                $patient_accounts->save();

                toastr()->success('تم تعديل دواء المريض بنجاح');
                return redirect()->route('Patient_Medicines.index');

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
        if(Auth::user()->job == 'دكتور')
        {
            PatientMedicine::destroy(strip_tags($request->id));
            PatientAccount ::where('medicine_id', strip_tags($request->id))->delete();

            toastr()->error('تم حذف دواء المريض بنجاح');
            return redirect()->back();
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }
}
