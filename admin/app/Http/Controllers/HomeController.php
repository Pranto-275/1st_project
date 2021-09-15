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


        $totalcourse = CourseModel::count();
        $totalservice = ServiceModel::count();
        $totalvisitor = VisitorModel::count();



        return view('Home', [
            'totalcourse' => $totalcourse,
            'totalservice' => $totalservice,
            'totalvisitor' => $totalvisitor
        ]);
    }
}
