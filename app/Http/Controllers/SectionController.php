<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Models\AppointmentDoctor;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::all();
        return view('Dashboard.Sections.index',compact('sections'));
    }

    public function store(Request $request)
    {
        Section::create([
            'name' => strip_tags($request->name),
            'description' => strip_tags($request->Disc),
            'create_by' => auth()->user()->name,
        ]);

        toastr()->success('تم إضافة القسم بنجاح');
        // session()->flash('add');
        return redirect()->route('Sections.index');
    }

    public function update(Request $request)
    {
        $section = Section::findOrFail(strip_tags($request->id));
        $section->update([
            'name' => strip_tags($request->name),
            'description' => strip_tags($request->Disc),
            'create_by' => auth()->user()->name,
        ]);
        toastr()->success('تم تعديل القسم بنجاح');
        // session()->flash('edit');
        return redirect()->route('Sections.index');
    }


    public function destroy(Request $request)
    {

        $MyDoctor_id = User::where('section_id',strip_tags($request->id))->pluck('section_id');

        if($MyDoctor_id->count() == 0){

            $Sections = section::findOrFail(strip_tags($request->id))->delete();
            toastr()->error('تم حذف القسم بنجاح');
            return redirect()->route('Sections.index');
        }

        else{

            toastr()->warning(' لايمكن حذف القسم بسبب وجود اطباء تابعة لـه احـذف الأطباء التابعة لـه ثم احذف القسم');
            return redirect()->route('Sections.index');
        }

        // Section::findOrFail(strip_tags($request->id))->delete();
        // session()->flash('delete');
        // return redirect()->route('Sections.index');
    }

    public function show($id)
    {
        $doctors =Section::findOrFail($id)->doctors;
        $AppointmentDoctors = AppointmentDoctor::where('section_id',$id)->get();
        $section = Section::findOrFail($id);
        return view('Dashboard.Sections.show_doctors',compact('doctors','section','AppointmentDoctors'));
    }
}
