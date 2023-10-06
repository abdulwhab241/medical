<?php

namespace App\Http\Controllers\Admin;

use App\Models\Insurance;
use Illuminate\Http\Request;
use App\Models\InsuranceDetails;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\InsuranceRequest;


class InsuranceController extends Controller
{
    public function index()
    {
        if(Auth::user()->job == 'admin')
        {
            $insurances = Insurance::where('year', date('Y'))->get();
            return view('Dashboard.Admin.insurance.index', compact('insurances'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();

    }

    public function create()
    {
        if(Auth::user()->job == 'admin')
        {
            return view('Dashboard.Admin.insurance.create');

        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }

    public function edit($id)
    {
        if(Auth::user()->job == 'admin')
        {
            $insurances = Insurance::findOrFail($id);
            return view('Dashboard.Admin.insurance.edit', compact('insurances'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();

    }

    public function store(InsuranceRequest $request)
    {
        if(Auth::user()->job == 'admin')
        {
            try {
                $insurances = new Insurance();
                $insurances->insurance_code = strip_tags($request->insurance_code);
                $insurances->name = strip_tags($request->name);
                $insurances->notes = strip_tags($request->notes);
                $insurances->status = 1;
                $insurances->date = date('Y-m-d');
                $insurances->year = date('Y');
                $insurances->create_by  = auth()->user()->name;
                $insurances->save();
    
                toastr()->success('تم إضافة بيانات شركة التأمين بنجاح');
                return redirect()->route('insurance.create');
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
            $insurances = Insurance::findOrFail(strip_tags($request->id));
            $insurances->insurance_code = strip_tags($request->insurance_code);
            $insurances->name = strip_tags($request->name);
            $insurances->notes = strip_tags($request->notes);
            $insurances->status = strip_tags($request->status);
            $insurances->date = date('Y-m-d');
            $insurances->year = date('Y');
            $insurances->create_by  = auth()->user()->name;
            $insurances->save();
    
            toastr()->success('تم تعديل بيانات شركة التأمين بنجاح');
            return redirect()->route('insurance.index');
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();


    }
    
    public function destroy(Request $request)
    {
        if(Auth::user()->job == 'admin')
        {
            $MyDetails_id = InsuranceDetails::where('insurance_id',strip_tags($request->id))->pluck('insurance_id');

            if($MyDetails_id->count() == 0){
    
                $insurances = Insurance::findOrFail(strip_tags($request->id))->delete();
                toastr()->error('تم حذف بيانات شركة التأمين بنجاح');
                return redirect()->route('insurance.index');
            }
    
            else{
    
                toastr()->info(' لايمكن حذف شركة التأمين بسبب وجود تفاصيل تابعة لـها احـذف التفاصيل التابعة لـها ثم احذف شركة التأمين');
                return redirect()->route('insurance.index');
            }
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }
}
