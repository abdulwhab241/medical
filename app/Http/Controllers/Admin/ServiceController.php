<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('Dashboard.Admin.Services.index',compact('services'));
    }

    public function store(Request $request)
    {
        try {
            $StoreService = new Service();
            $StoreService->name = strip_tags($request->name);
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

    public function update(Request $request)
    {
        try {

            $UpdateService = Service::findOrFail(strip_tags($request->id));
            $UpdateService->name = strip_tags($request->name);
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

    public function destroy(Request $request)
    {
        Service::destroy(strip_tags($request->id));
        toastr()->error('تم حذف الإجراء بنجاح');
        return redirect()->back();
    }

}
