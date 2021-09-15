<?php

namespace App\Http\Controllers;

use App\ContactModel;
use App\CourseModel;
use App\ProjectsModel;
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

        $ProjectData = json_decode(ProjectsModel::orderBy('id', 'desc')->limit(10)->get());


        return view('Home', [
            'ServicesData' => $ServicesData,
            'CoursesData' => $CoursesData,
            'ProjectData' => $ProjectData
        ]);
    }



    public function Contactsend(Request $request)
    {
        $name = $request->input('contact_name');
        $mobile = $request->input('contact_mobile');
        $email = $request->input('contact_email');
        $msg = $request->input('contact_msg');


        $result =  ContactModel::insert([
            'contact_name' => $name,
            'contact_mobile' => $mobile,
            'contact_email' => $email,
            'contact_msg' => $msg
        ]);

        if ($result == true) {
            return 1;
        } else {
            return 0;
        }
    }
}
