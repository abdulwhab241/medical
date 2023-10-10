<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\LaboratoryService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LaboratoryServiceController extends Controller
{
    public function index()
    {
        if(Auth::user()->job == 'admin')
        {
            $LaboratoryServices = LaboratoryService::all();
            return view('Dashboard.Admin.Laboratory_Services.index',compact('LaboratoryServices'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }

    public function store(Request $request)
    {
        if(Auth::user()->job == 'admin')
        {
            try {
                $LaboratoryService = new LaboratoryService();
                $LaboratoryService->name = strip_tags($request->name);
                $LaboratoryService->price = strip_tags($request->price);
                $LaboratoryService->description = strip_tags($request->description);
                $LaboratoryService->status = 1;
                $LaboratoryService->date = date('y-m-d');
                $LaboratoryService->year = date('Y');
                $LaboratoryService->create_by  = auth()->user()->name;
                $LaboratoryService->save();
    
                toastr()->success('تم إضافة الفحص بنجاح');
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

                $LaboratoryService = LaboratoryService::findOrFail(strip_tags($request->id));
                $LaboratoryService->name = strip_tags($request->name);
                $LaboratoryService->price = strip_tags($request->price);
                $LaboratoryService->description = strip_tags($request->description);
                $LaboratoryService->status = strip_tags($request->status);
                $LaboratoryService->date = date('y-m-d');
                $LaboratoryService->year = date('Y');
                $LaboratoryService->create_by  = auth()->user()->name;
                $LaboratoryService->save();
    
    
                toastr()->success('تم تعديل الفحص بنجاح');
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
            LaboratoryService::destroy(strip_tags($request->id));
            toastr()->error('تم حذف الفحص بنجاح');
            return redirect()->back();
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();

    }
}
