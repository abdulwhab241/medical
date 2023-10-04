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

    public function Get_Prices($id){

        $list_price = Service::where("id", $id)->pluck("price", "id");
        return $list_price;
    }

    public function Get_Discounts($id){

        $list_price = InsuranceDetails::where("id", $id)->where('status', 1)->pluck("discount_percentage", "id");
        return $list_price;
    }
}
