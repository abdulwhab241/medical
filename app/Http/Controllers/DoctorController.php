<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Section;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\AppointmentDoctor;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreDoctorsRequest;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = User::with('doctor_appointments')->get();
        $AppointmentDoctors = AppointmentDoctor::distinct()->get(['day_id']);
        return view('Dashboard.Doctors.index',compact('doctors','AppointmentDoctors'));
    }

    public function create()
    {
        $sections = Section::all();
        $sections = Section::all();
        $appointments = Appointment::all();
        return view('Dashboard.Doctors.add',compact('sections','appointments'));
    }

    public function store(StoreDoctorsRequest $request){

        // DB::beginTransaction();

        try {

            $doctors = new User();
            $doctors->name = strip_tags($request->name);
            $doctors->password = Hash::make(strip_tags($request->password));
            $doctors->section_id = strip_tags($request->section_id);
            $doctors->phone = strip_tags($request->phone);
            $doctors->disc = 'دكتور';
            $doctors->address = strip_tags($request->address);
            $doctors->status = 1;
            $doctors->save();


            $AppointmentDoctor = new AppointmentDoctor();
            $AppointmentDoctor->user_doctor_id = $doctors->id;
            $AppointmentDoctor->day_id = strip_tags($request->day_id);
            $AppointmentDoctor->year = date('Y');
            $AppointmentDoctor->create_by = auth()->user()->name;
            $AppointmentDoctor->save();
            // insert pivot tABLE
            // $doctors->doctorappointments()->attach($request->appointments);


            //Upload img
            $this->verifyAndStoreImage($request,'photo','doctors','upload_image',$doctors->id,'App\Models\Doctor');

            // DB::commit();
            session()->flash('add');
            return redirect()->route('Doctors.create');

        }
        catch (\Exception $e) {
            // DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function update($request)
    {
        // DB::beginTransaction();

        try {

            $doctor = User::findOrFail(strip_tags($request->id));

            $doctor->name = strip_tags($request->name);
            $doctor->password = Hash::make(strip_tags($request->password));
            $doctor->section_id = strip_tags($request->section_id);
            $doctor->phone = strip_tags($request->phone);
            $doctor->disc = 'دكتور';
            $doctor->address = strip_tags($request->address);
            $doctor->status = 1;
            $doctor->save();

            $AppointmentDoctor = new AppointmentDoctor();
            $AppointmentDoctor->user_doctor_id = strip_tags($request->id);
            $AppointmentDoctor->day_id = strip_tags($request->day_id);
            $AppointmentDoctor->year = date('Y');
            $AppointmentDoctor->create_by = auth()->user()->name;
            $AppointmentDoctor->save();

            // update pivot tABLE
            // $doctor->doctorappointments()->sync($request->appointments);

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
            session()->flash('edit');
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
          session()->flash('delete');
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
          session()->flash('delete');
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

            session()->flash('edit');
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

            session()->flash('edit');
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
