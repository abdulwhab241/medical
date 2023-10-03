<?php

namespace App\Http\Controllers;

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
}
