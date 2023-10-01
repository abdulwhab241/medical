<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\User;
use App\Models\Section;
use App\Models\Appointment;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use App\Models\AppointmentDoctor;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreDoctorsRequest;

class DoctorController extends Controller
{
    use UploadTrait;
    
    public function index()
    {
        $name = 'دكتور' ;
        $doctors = User::where('job',$name)->get();
        $AppointmentDoctors = AppointmentDoctor::all();
        return view('Dashboard.Doctors.index',compact('doctors','AppointmentDoctors'));
    }

    public function create()
    {
        $sections = Section::all();
        $Days = Day::all();
        return view('Dashboard.Doctors.add',compact('sections','Days'));
    }

    public function store(Request $request){
        // return $request;

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
            $doctors->create_by = auth()->user()->name;
            $doctors->save();
            // $doctors->doctor_appointments()->attach($request->day_id);

            $AppointmentDoctor = new AppointmentDoctor();
            $AppointmentDoctor->user_id = $doctors->id;
            $AppointmentDoctor->day = implode(' و ', $request->day_id);
            $AppointmentDoctor->section_id = strip_tags($request->section_id);
            $AppointmentDoctor->year =date('Y');
            $AppointmentDoctor->create_by = auth()->user()->name;
            $AppointmentDoctor->save();

            // foreach ($request->day_id as $Doc){
            //     $ids = explode(',',$Doc);
    
            //     AppointmentDoctor::updateOrCreate([
            //         'day' => $$Doc,
            //         'user_id' => $doctors->id,
            //         'section_id' => ,
            //         'year' =>  ,
            //         'create_by' => ,
            //     ]);
            // }
            // return $ids;
           



            //Upload img
            $this->verifyAndStoreImage($request,'photo','doctors','upload_image',$doctors->id,'App\Models\User');

            toastr()->success('تم إضافة الطبيب بنجاح');
            return redirect()->route('Doctors.create');

        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function update($request)
    {

        try {

            $doctor = User::findOrFail(strip_tags($request->id));

            $doctor->name = strip_tags($request->name);
            $doctor->password = Hash::make(strip_tags($request->password));
            $doctor->section_id = strip_tags($request->section_id);
            $doctor->phone = strip_tags($request->phone);
            $doctor->disc = 'دكتور';
            $doctor->address = strip_tags($request->address);
            $doctor->status = 1;
            $doctor->date = date('Y-m-d');
            $doctor->create_by = auth()->user()->name;
            $doctor->save();

            $AppointmentDoctor = new AppointmentDoctor();
            $AppointmentDoctor->user_id = strip_tags($request->id);
            $AppointmentDoctor->section_id = strip_tags($request->section_id);
            $AppointmentDoctor->day = strip_tags($request->day_id);
            $AppointmentDoctor->year = date('Y');
            $AppointmentDoctor->create_by = auth()->user()->name;
            $AppointmentDoctor->save();
            

            // update pivot tABLE
            // $doctor->doctorappointments()->sync($request->appointments);

            // insert img
            // if($request->hasfile('photos'))
            // {
            //     foreach($request->file('photos') as $file)
            //     {
            //         $name = $file->getClientOriginalName();
            //         $file->storeAs('attachments/students/'.$students->name, $file->getClientOriginalName(),'upload_attachments');

            //         // insert in image_table
            //         $images= new Image();
            //         $images->filename=$name;
            //         $images->imageable_id= $students->id;
            //         $images->imageable_type = 'App\Models\Student';
            //         $images->save();
            //     }
            // }

            // update photo
            if ($request->has('photo')){
                // Delete old photo
                if ($doctor->image){
                    $old_img = $doctor->image->filename;
                    $this->Delete_attachment('upload_image','doctors/'.$old_img,$request->id);
                }
                //Upload img
                $this->verifyAndStoreImage($request,'photo','doctors','upload_image',$request->id,'App\Models\Doctor');
            }

            // DB::commit();
        toastr()->success('تم تعديل الطبيب بنجاح');
            // session()->flash('edit');
            return redirect()->back();

        }
        catch (\Exception $e) {
            // DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        if($request->page_id==1){

        if($request->filename){

            $this->Delete_attachment('upload_image','doctors/'.$request->filename,$request->id,$request->filename);
        }
            User::destroy(strip_tags($request->id));
            toastr()->error('تم حذف الطبيب بنجاح');
            // session()->flash('delete');
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
            // session()->flash('delete');
            return redirect()->route('Doctors.index');
        }

    }


    public function edit($id)
    {
        $sections = Section::all();
        $appointments = Appointment::all();
        $doctor = User::findOrFail($id);
        return view('Dashboard.Doctors.edit',compact('sections','appointments','doctor'));
    }

    public function update_password($request)
    {
        try {
            $doctor = User::findOrFail(strip_tags($request->id));
            $doctor->update([
                'password'=>Hash::make(strip_tags($request->password))
            ]);

            // session()->flash('edit');
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update_status($request)
    {
        try {
            $doctor = User::findOrFail(strip_tags($request->id));
            $doctor->update([
                'status'=> strip_tags($request->status)
            ]);

            // session()->flash('edit');
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
