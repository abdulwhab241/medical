<?php

namespace App\Http\Controllers\Admin;

use App\Models\RayService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RayServiceController extends Controller
{
    public function index()
    {
        if(Auth::user()->job == 'admin')
        {
            $Rays = RayService::all();
            return view('Dashboard.Admin.Ray_Services.index',compact('Rays'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }

    public function store(Request $request)
    {
        if(Auth::user()->job == 'admin')
        {
            try {
                $RayService = new RayService();
                $RayService->name = strip_tags($request->name);
                $RayService->price = strip_tags($request->price);
                $RayService->description = strip_tags($request->description);
                $RayService->status = 1;
                $RayService->date = date('y-m-d');
                $RayService->year = date('Y');
                $RayService->create_by  = auth()->user()->name;
                $RayService->save();
    
                toastr()->success('تم إضافة الأشعة بنجاح');
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

                $RayService = RayService::findOrFail(strip_tags($request->id));
                $RayService->name = strip_tags($request->name);
                $RayService->price = strip_tags($request->price);
                $RayService->description = strip_tags($request->description);
                $RayService->status = strip_tags($request->status);
                $RayService->date = date('y-m-d');
                $RayService->year = date('Y');
                $RayService->create_by  = auth()->user()->name;
                $RayService->save();
    
    
                toastr()->success('تم تعديل الأشعة بنجاح');
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
            RayService::destroy(strip_tags($request->id));
            toastr()->error('تم حذف الأشعة بنجاح');
            return redirect()->back();
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }
}
