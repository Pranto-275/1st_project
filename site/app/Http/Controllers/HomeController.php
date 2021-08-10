<?php

namespace App\Http\Controllers;

use App\ServiceModel;
use App\VisitorModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function HomeIndex()
    {
        $UserIP = $_SERVER['REMOTE_ADDR'];
        date_default_timezone_set("Asia/Dhaka");
        $timeDate = date("y-m-d h:i:sa");
        VisitorModel::insert(['ip_address' => $UserIP, 'Visit_time' => $timeDate]);

        $ServicesData = json_decode(ServiceModel::all());


        return view('Home', ['ServicesData' => $ServicesData]);
    }
}
