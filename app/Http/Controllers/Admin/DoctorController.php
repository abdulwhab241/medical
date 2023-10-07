<?php

namespace App\Http\Controllers\Admin;

use App\Models\Day;
use App\Models\User;
use App\Models\Section;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\DoctorRequest;

class DoctorController extends Controller
{
    use UploadTrait;
    
    public function index()
    {
        if(Auth::user()->job == 'admin')
        {
            $doctors = User::where('job','دكتور')->get();
            return view('Dashboard.Admin.Doctors.index',compact('doctors'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();

    }

    public function create()
    {
        if(Auth::user()->job == 'admin')
        {
            $sections = Section::all();
            $Days = Day::all();
            return view('Dashboard.Admin.Doctors.add',compact('sections','Days'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();
    }

    
    public function edit($id)
    {
        if(Auth::user()->job == 'admin')
        {
            $sections = Section::all();
            $Days = Day::all();
            $doctor = User::findOrFail($id);
            return view('Dashboard.Admin.Doctors.edit',compact('sections','doctor','Days'));
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();

    }

    public function store(DoctorRequest $request){

        if(Auth::user()->job == 'admin')
        {
            try {

                $doctors = new User();
                $doctors->name = strip_tags($request->name);
                $doctors->password = Hash::make(strip_tags($request->phone));
                $doctors->section_id = strip_tags($request->section_id);
                $doctors->phone = strip_tags($request->phone);
                $doctors->job = 'دكتور';
                $doctors->address = strip_tags($request->address);
                $doctors->status = 1;
                $doctors->date = date('Y-m-d');
                $doctors->day = implode(' و ', $request->day_id);
                $doctors->create_by = auth()->user()->name;
                $doctors->save();
    
                //Upload img
                $this->verifyAndStoreImage($request,'photo','doctors','upload_image',$doctors->id,'App\Models\User');
    
                toastr()->success('تم إضافة الطبيب بنجاح');
                return redirect()->route('Doctors.create');
    
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

                $doctor = User::findOrFail(strip_tags($request->id));
    
                $doctor->name = strip_tags($request->name);
                $doctor->password = Hash::make(strip_tags($request->phone));
                $doctor->section_id = strip_tags($request->section_id);
                $doctor->phone = strip_tags($request->phone);
                $doctor->job = 'دكتور';
                $doctor->address = strip_tags($request->address);
                $doctor->status = 1;
                $doctor->date = date('Y-m-d');
                $doctor->day = implode(' و ', $request->day_id);
                $doctor->create_by = auth()->user()->name;
                $doctor->save();
    
    
                // update photo
                if ($request->has('photo')){
                    // Delete old photo
                    if ($doctor->image){
                        $old_img = $doctor->image->filename;
                        $this->Delete_attachment('upload_image','doctors/'.$old_img,$request->id);
                    }
                    //Upload img
                    $this->verifyAndStoreImage($request,'photo','doctors','upload_image',$request->id,'App\Models\User');
                }
    
                toastr()->success('تم تعديل الطبيب بنجاح');
                return redirect()->route('Doctors.index');
    
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
            if($request->page_id==1){

                if($request->filename){
        
                    $this->Delete_attachment('upload_image','doctors/'.$request->filename,$request->id, $request->filename);
                }
                    User::destroy(strip_tags($request->id));
                    toastr()->error('تم حذف الطبيب بنجاح');
                    return redirect()->route('Doctors.index');
                }
        
        
              //---------------------------------------------------------------
        
            else{

                // delete selector doctor
                $delete_select_id = explode(",", $request->delete_select_id);
                foreach ($delete_select_id as $ids_doctors){
                    $doctor = User::findOrFail($ids_doctors);
                    if($doctor->image){
                        $this->Delete_attachment('upload_image','doctors/'.$doctor->image->filename,$ids_doctors,$doctor->image->filename);
                    }
                }

                User::destroy($delete_select_id);
                toastr()->error('تم حذف الاطباء بنجاح');
                return redirect()->route('Doctors.index');
            }
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();

    }



    public function update_password(Request $request)
    {
        if(Auth::user()->job == 'admin')
        {
            try {
                $doctor = User::findOrFail(strip_tags($request->id));
                $doctor->password = Hash::make(strip_tags($request->password));
                $doctor->save();
    
                toastr()->success('تم تعديل كلمة المرور بنجاح');
                return redirect()->back();
            }
    
            catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();

    }

    public function update_status(Request $request)
    {
        if(Auth::user()->job == 'admin')
        {
            try {
                $doctor = User::findOrFail(strip_tags($request->id));
                $doctor->status = strip_tags($request->status);
                $doctor->save();
    
                toastr()->success('تم تعديل حالة الطبيب بنجاح');
                return redirect()->back();
            }
    
            catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        }
        toastr()->error('لا يمكنك الدخول ');
        return redirect()->back();

    }
}
