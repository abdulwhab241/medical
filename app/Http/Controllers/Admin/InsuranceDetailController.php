<?php

namespace App\Http\Controllers\Admin;

use App\Models\Insurance;
use Illuminate\Http\Request;
use App\Models\InsuranceDetails;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\InsuranceDetailRequest;


class InsuranceDetailController extends Controller
{
    public function index()
    {
        if(Auth::user()->job == 'admin')
        {
            $InsuranceDetails = InsuranceDetails::where('year', date('Y'))->get();
            return view('Dashboard.Admin.Insurance_Details.index', compact('InsuranceDetails'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();

    }

    public function create()
    {
        if(Auth::user()->job == 'admin')
        {
            $Insurances = Insurance::where('year', date('Y'))->get();
            return view('Dashboard.Admin.Insurance_Details.create', compact('Insurances'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
 
    }

    public function edit($id)
    {
        if(Auth::user()->job == 'admin')
        {
            $Insurances = Insurance::where('year', date('Y'))->get();
            $InsuranceDetails = InsuranceDetails::findOrFail($id);
            return view('Dashboard.Admin.Insurance_Details.edit', compact('InsuranceDetails','Insurances'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();

    }

    public function store(InsuranceDetailRequest $request)
    {
        if(Auth::user()->job == 'admin')
        {
            try {
                $insurances = new InsuranceDetails();
                $insurances->insurance_id = strip_tags($request->Insurance_id);
                $insurances->name = strip_tags($request->Name);
                $insurances->insurance_code = strip_tags($request->Insurance_code);
                $insurances->discount_percentage = strip_tags($request->Discount_percentage);
                $insurances->company_rate = strip_tags($request->Company_rate);
                $insurances->notes = strip_tags($request->Notes);
                $insurances->status = 1;
                // $insurances->date = date('Y-m-d');
                $insurances->year = date('Y');
                $insurances->create_by  = auth()->user()->name;
                $insurances->save();
    
                toastr()->success('تم إضافة بيانات تفاصيل شركة التأمين بنجاح');
                return redirect()->route('InsuranceDetails.create');
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

            $insurances = InsuranceDetails::findOrFail(strip_tags($request->id));
            $insurances->insurance_id = strip_tags($request->Insurance_id);
            $insurances->name = strip_tags($request->Name);
            $insurances->insurance_code = strip_tags($request->Insurance_code);
            $insurances->discount_percentage = strip_tags($request->Discount_percentage);
            $insurances->company_rate = strip_tags($request->Company_rate);
            $insurances->notes = strip_tags($request->Notes);
            $insurances->status = strip_tags($request->Status);
            // $insurances->date = date('Y-m-d');
            $insurances->year = date('Y');
            $insurances->create_by  = auth()->user()->name;
            $insurances->save();
    
            toastr()->success('تم تعديل بيانات تفاصيل شركة التأمين بنجاح');
            return redirect()->route('InsuranceDetails.index');
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();

    }

    public function destroy(Request $request)
    {
        if(Auth::user()->job == 'admin')
        {
            InsuranceDetails::destroy(strip_tags($request->id));
            toastr()->error('تم حذف بيانات شركة التأمين بنجاح');
            return redirect()->route('InsuranceDetails.index');
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }
}
