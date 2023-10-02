<?php

namespace App\Http\Controllers\Admin;

use App\Models\Insurance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InsuranceController extends Controller
{
    public function index()
    {
        $insurances = Insurance::all();
        return view('Dashboard.insurance.index', compact('insurances'));
    }

    public function create()
    {
        return view('Dashboard.insurance.create');
    }

    public function edit($id)
    {
        $insurances = insurance::findOrFail($id);
        return view('Dashboard.insurance.edit', compact('insurances'));
    }

    public function store(Request $request)
    {
        try {
            $insurances = new insurance();
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

        $insurances = insurance::findOrFail(strip_tags($request->id));
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
        insurance::destroy(strip_tags($request->id));
        toastr()->error('تم حذف بيانات شركة التأمين بنجاح');
        return redirect('insurance');
    }
}
