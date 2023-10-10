<?php

namespace App\Http\Controllers;

use App\Models\InsuranceDetails;
use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('sign_in');
    }

    // public function Get_doctors($id){

    //     $list_price = Service::where("user_doctor_id", $id)->pluck("price", "id");
    //     return $list_price;
    // }

    public function Get_Prices($id){

        $list_price = Service::where("user_doctor_id", $id)->pluck("price", "id");
        return $list_price;
    }

}
