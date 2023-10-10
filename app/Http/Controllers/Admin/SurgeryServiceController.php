<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\SurgeryService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SurgeryServiceController extends Controller
{
    public function index()
    {
        if(Auth::user()->job == 'admin')
        {
            $Surgeries = SurgeryService::all();
            return view('Dashboard.Admin.Surgery_Services.index',compact('Surgeries'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }

    public function store(Request $request)
    {
        if(Auth::user()->job == 'admin')
        {
            try {
                $SurgeryService = new SurgeryService();
                $SurgeryService->name = strip_tags($request->name);
                $SurgeryService->price = strip_tags($request->price);
                $SurgeryService->description = strip_tags($request->description);
                $SurgeryService->status = 1;
                $SurgeryService->date = date('y-m-d');
                $SurgeryService->year = date('Y');
                $SurgeryService->create_by  = auth()->user()->name;
                $SurgeryService->save();
    
                toastr()->success('تم إضافة العملية الجراحية بنجاح');
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

                $SurgeryService = SurgeryService::findOrFail(strip_tags($request->id));
                $SurgeryService->name = strip_tags($request->name);
                $SurgeryService->price = strip_tags($request->price);
                $SurgeryService->description = strip_tags($request->description);
                $SurgeryService->status = strip_tags($request->status);
                $SurgeryService->date = date('y-m-d');
                $SurgeryService->year = date('Y');
                $SurgeryService->create_by  = auth()->user()->name;
                $SurgeryService->save();
    
    
                toastr()->success('تم تعديل العملية الجراحية بنجاح');
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
            SurgeryService::destroy(strip_tags($request->id));
            toastr()->error('تم حذف العملية الجراحية بنجاح');
            return redirect()->back();
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }
}
