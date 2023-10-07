<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    use UploadTrait;
    
    public function index()
    {
        if(Auth::user()->job == 'admin')
        {
            $Users =  User::findOrFail(auth()->user()->id);
            return view('Dashboard.Admin.profile',compact('Users'));
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
                $doctor->password = Hash::make(strip_tags($request->password));
                $doctor->phone = strip_tags($request->phone);
                $doctor->address = strip_tags($request->address);
                $doctor->save();
    
    
                // update photo
                if ($request->has('photo')){
                    // Delete old photo
                    if ($doctor->image){
                        $old_img = $doctor->image->filename;
                        $this->Delete_attachment('upload_image','users/'.$old_img,$request->id);
                    }
                    //Upload img
                    $this->verifyAndStoreImage($request,'photo','users','upload_image',$request->id,'App\Models\User');
                }
    
                toastr()->success('تم تعديل البيانات بنجاح');
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
