<?php

namespace App\Http\Controllers;

use App\CourseModel;
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

        $CoursesData = json_decode(CourseModel::orderBy('id', 'desc')->limit(6)->get());


        return view('Home', ['ServicesData' => $ServicesData], ['CoursesData' => $CoursesData]);
    }
}
