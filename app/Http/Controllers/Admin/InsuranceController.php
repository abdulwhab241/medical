<?php

namespace App\Http\Controllers\Admin;

use App\Models\Insurance;
use Illuminate\Http\Request;
use App\Models\InsuranceDetails;
use App\Http\Controllers\Controller;
use App\Http\Requests\InsuranceRequest;

class InsuranceController extends Controller
{
    public function index()
    {
        $insurances = Insurance::where('year', date('Y'))->get();
        return view('Dashboard.insurance.index', compact('insurances'));
    }

    public function create()
    {
        return view('Dashboard.insurance.create');
    }

    public function edit($id)
    {
        $insurances = Insurance::findOrFail($id);
        return view('Dashboard.insurance.edit', compact('insurances'));
    }

    public function store(InsuranceRequest $request)
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

    public function update(Request $request)
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
    
    public function destroy(Request $request)
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
}
