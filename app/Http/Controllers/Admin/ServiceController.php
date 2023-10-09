<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function index()
    {
        if(Auth::user()->job == 'admin')
        {
            $services = Service::all();
            $Doctors = User::where('job', 'دكتور')->get();
            return view('Dashboard.Admin.Services.index',compact('services','Doctors'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();

    }

    public function store(Request $request)
    {
        if(Auth::user()->job == 'admin')
        {
            try {
                $StoreService = new Service();
                $StoreService->name = strip_tags($request->name);
                $StoreService->user_doctor_id = strip_tags($request->Doctor_id);
                $StoreService->price = strip_tags($request->price);
                $StoreService->description = strip_tags($request->description);
                $StoreService->status = 1;
                $StoreService->year = date('Y');
                $StoreService->create_by  = auth()->user()->name;
                $StoreService->save();
    
                toastr()->success('تم إضافة الإجراء بنجاح');
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
            try {

                $UpdateService = Service::findOrFail(strip_tags($request->id));
                $UpdateService->name = strip_tags($request->name);
                $UpdateService->user_doctor_id = strip_tags($request->Doctor_id);
                $UpdateService->price = strip_tags($request->price);
                $UpdateService->description = strip_tags($request->description);
                $UpdateService->status = strip_tags($request->status);
                $UpdateService->year = date('Y');
                $UpdateService->create_by  = auth()->user()->name;
                $UpdateService->save();
    
    
                toastr()->success('تم تعديل الإجراء بنجاح');
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
            Service::destroy(strip_tags($request->id));
            toastr()->error('تم حذف الإجراء بنجاح');
            return redirect()->back();
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();

    }

}
