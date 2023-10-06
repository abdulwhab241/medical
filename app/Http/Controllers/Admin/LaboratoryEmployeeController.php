<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LaboratoryEmployeeController extends Controller
{
    public function index()
    {
        if(Auth::user()->job == 'admin')
        {
            $Laboratory_Employees =  User::where('job', 'المختبر')->get();
            return view('Dashboard.Admin.Laboratory_Employee.index',compact('Laboratory_Employees'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }

    public function store(Request $request){

        if(Auth::user()->job == 'admin')
        {
            try {

                $doctors = new User();
                $doctors->name = strip_tags($request->Name);
                $doctors->password = Hash::make(strip_tags($request->Phone));
                $doctors->phone = strip_tags($request->Phone);
                $doctors->job = 'المختبر';
                $doctors->address = strip_tags($request->Address);
                $doctors->status = 1;
                $doctors->date = date('Y-m-d');
                $doctors->create_by = auth()->user()->name;
                $doctors->save();
    
                //Upload img
                // $this->verifyAndStoreImage($request,'photo','doctors','upload_image',$doctors->id,'App\Models\User');
    
                toastr()->success('تم إضافة بيانات موظف المختبر بنجاح');
                return redirect()->back();
    
            }
            catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }

    public function update(Request $request){

        if(Auth::user()->job == 'admin')
        {
            try {

                $doctors = User::findOrFail(strip_tags($request->id));
                $doctors->name = strip_tags($request->Name);
                $doctors->password = Hash::make(strip_tags($request->Phone));
                $doctors->phone = strip_tags($request->Phone);
                $doctors->job = 'المختبر';
                $doctors->address = strip_tags($request->Address);
                $doctors->status = 1;
                $doctors->date = date('Y-m-d');
                $doctors->create_by = auth()->user()->name;
                $doctors->save();
    
                //Upload img
                // $this->verifyAndStoreImage($request,'photo','doctors','upload_image',$doctors->id,'App\Models\User');
    
                toastr()->success('تم تعديل بيانات موظف المختبر بنجاح');
                return redirect()->back();
    
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
            User ::destroy(strip_tags($request->id));

            toastr()->error('تم حذف بيانات موظف المختبر بنجاح');
            return redirect()->back();
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }
}
