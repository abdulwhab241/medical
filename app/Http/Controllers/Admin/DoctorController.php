<?php

namespace App\Http\Controllers\Admin;

use App\Models\Day;
use App\Models\User;
use App\Models\Section;
use App\Traits\UploadTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    use UploadTrait;
    
    public function index()
    {
        $name = 'دكتور' ;
        $doctors = User::where('job',$name)->get();
        return view('Dashboard.Doctors.index',compact('doctors'));
    }

    public function create()
    {
        $sections = Section::all();
        $Days = Day::all();
        return view('Dashboard.Doctors.add',compact('sections','Days'));
    }

    public function store(DoctorRequest $request){

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

    public function update(Request $request)
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

    public function destroy(Request $request)
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


    public function edit($id)
    {
        $sections = Section::all();
        $Days = Day::all();
        $doctor = User::findOrFail($id);
        return view('Dashboard.Doctors.edit',compact('sections','doctor','Days'));
    }

    public function update_password(Request $request)
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

    public function update_status(Request $request)
    {
        // return $request;
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
}
