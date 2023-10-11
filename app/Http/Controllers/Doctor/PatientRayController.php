<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use App\Models\PatientAccount;
use App\Http\Controllers\Controller;
use App\Models\PatientRay;
use App\Models\RayService;
use Illuminate\Support\Facades\Auth;

class PatientRayController extends Controller
{
    public function index()
    {
        if(Auth::user()->job == 'دكتور')
        {
            $PatientRays = PatientRay::where('user_doctor_id', auth()->user()->id)->get();
            $Rays = RayService::all();

            return view('Dashboard.Dashboard_Doctors.Patient_Xray.index',compact('PatientRays','Rays'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }
    public function store(Request $request)
    {
        if(Auth::user()->job == 'دكتور')
        {
            // dd();
            try{

                $Rays = $request->Ray_id;
                foreach($Rays as $Ray)
                {
                    $PatientRays = new PatientRay();
                    $PatientRays->patient_id = strip_tags($request->Patient_id);
                    $PatientRays->user_doctor_id = auth()->user()->id;
                    $PatientRays->ray_id = $Ray;
                    $PatientRays->description = strip_tags($request->Disc);
                    $PatientRays->date =date('y-m-d');
                    $PatientRays->year =date('Y');
                    $PatientRays->create_by = auth()->user()->name;
                    $PatientRays->save();
    
    
                    $patient_accounts = new PatientAccount();
                    $patient_accounts->patient_id = strip_tags($request->Patient_id);
                    $patient_accounts->ray_id = $PatientRays->id;
                    $patient_accounts->date =date('y-m-d');
                    $patient_accounts->year =date('Y');
                    $patient_accounts->create_by = auth()->user()->name;
                    $patient_accounts->save();
                }



                toastr()->success('تم تحويل المريض الى الأشعة بنجاح');
                // return redirect()->back();
                return redirect()->route('patient_cash');

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

                    $PatientRays = PatientRay::findOrFail(strip_tags($request->id));
                    $PatientRays->patient_id = strip_tags($request->Patient_id);
                    $PatientRays->user_doctor_id = auth()->user()->id;
                    $PatientRays->ray_id = strip_tags($request->Ray_id);
                    $PatientRays->description = strip_tags($request->Disc);
                    $PatientRays->date =date('y-m-d');
                    $PatientRays->year =date('Y');
                    $PatientRays->create_by = auth()->user()->name;
                    $PatientRays->save();
    
    
                    $patient_accounts = PatientAccount::where('ray_id',strip_tags($request->id))->first();
                    // $patient_accounts->patient_id = strip_tags($request->Patient_id);
                    // $patient_accounts->ray_id = strip_tags($request->Ray_id);
                    $patient_accounts->date =date('y-m-d');
                    $patient_accounts->year =date('Y');
                    $patient_accounts->create_by = auth()->user()->name;
                    $patient_accounts->save();



                toastr()->success('تم تعديل تحويل المريض الى الأشعة بنجاح');
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
            PatientAccount::where('ray_id', strip_tags($request->id))->delete();
            PatientRay::destroy(strip_tags($request->id));

            toastr()->error('تم حذف تحويل المريض الى الأشعة بنجاح');
            return redirect()->back();
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }
}
