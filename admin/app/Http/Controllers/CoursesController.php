<?php

namespace App\Http\Controllers;

use App\CourseModel;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function CoursesIndex()
    {
        return view('Courses');
    }


    public function getCourseData()
    {
        $result = json_encode(CourseModel::all());
        return $result;
    }



    //get details
    public function getCoursesDetails(Request $request)
    {
        $id = $request->input('id');
        $result = json_encode(CourseModel::where('id', '=', $id)->get());
        return $result;
    }


    //course delete

    public function CoursesDelete(Request $request)
    {
        $id = $request->input('id');

        $result = CourseModel::where('id', '=', $id)->delete();

        if ($result == true) {
            return 1;
        } else {
            return 0;
        }
    }


    //course update

    function CoursesUpdate(Request $req)
    {
        $id = $req->input('id');
        $course_name = $req->input('course_name');
        $course_des = $req->input('course_des');
        $course_fee = $req->input('course_fee');
        $course_totalenroll = $req->input('course_totalenroll');
        $course_totalclass = $req->input('course_totalclass');
        $course_link = $req->input('course_link');
        $course_img = $req->input('course_img');

        $result = CourseModel::where('id', '=', $id)->update([
            'course_name' => $course_name,
            'course_des' => $course_des,
            'course_fee' => $course_fee,
            'course_totalenroll' => $course_totalenroll,
            'course_coursetotalclass' => $course_totalclass,
            'course_link' => $course_link,
            'course_img' => $course_img,
        ]);

        if ($result == true) {
            return 1;
        } else {
            return 0;
        }
    }


    //course add

    function CoursesAdd(Request $req)
    {
        $course_name = $req->input('course_name');
        $course_des = $req->input('course_des');
        $course_fee = $req->input('course_fee');
        $course_totalenroll = $req->input('course_totalenroll');
        $course_totalclass = $req->input('course_totalclass');
        $course_link = $req->input('course_link');
        $course_img = $req->input('course_img');
        $result = CourseModel::insert([
            'course_name' => $course_name,
            'course_des' => $course_des,
            'course_fee' => $course_fee,
            'course_totalenroll' => $course_totalenroll,
            'course_coursetotalclass' => $course_totalclass,
            'course_link' => $course_link,
            'course_img' => $course_img,
        ]);

        if ($result == true) {
            return 1;
        } else {
            return 0;
        }
    }
}
