<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    public function index()
    {
        if(Auth::user()->job == 'admin')
        {
            $sections = Section::all();
            return view('Dashboard.Admin.Sections.index',compact('sections'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();

    }

    public function show($id)
    {
        if(Auth::user()->job == 'admin')
        {
            $doctors =Section::findOrFail($id)->doctors;
            $section = Section::findOrFail($id);
            return view('Dashboard.Admin.Sections.show_doctors',compact('doctors','section'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();

    }

    public function store(Request $request)
    {
        if(Auth::user()->job == 'admin')
        {
            Section::create([
                'name' => strip_tags($request->name),
                'description' => strip_tags($request->Disc),
                'create_by' => auth()->user()->name,
            ]);
    
            toastr()->success('تم إضافة القسم بنجاح');
            return redirect()->route('Sections.index');
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();

    }

    public function update(Request $request)
    {
        if(Auth::user()->job == 'admin')
        {
            $section = Section::findOrFail(strip_tags($request->id));
            $section->update([
                'name' => strip_tags($request->name),
                'description' => strip_tags($request->Disc),
                'create_by' => auth()->user()->name,
            ]);
            toastr()->success('تم تعديل القسم بنجاح');
            return redirect()->route('Sections.index');
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();

    }


    public function destroy(Request $request)
    {
        if(Auth::user()->job == 'admin')
        {
            $MyDoctor_id = User::where('section_id',strip_tags($request->id))->pluck('section_id');

            if($MyDoctor_id->count() == 0){
    
                $Sections = section::findOrFail(strip_tags($request->id))->delete();
                toastr()->error('تم حذف القسم بنجاح');
                return redirect()->route('Sections.index');
            }
    
            else{
    
                toastr()->info(' لايمكن حذف القسم بسبب وجود اطباء تابعة لـه احـذف الأطباء التابعة لـه ثم احذف القسم');
                return redirect()->route('Sections.index');
            }
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();

    }


}
