<?php

namespace App\Http\Controllers;

use App\ServiceModel;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function ServiceIndex()
    {
        return view('Services');
    }


    public function getServiceData()
    {
        $result = json_encode(ServiceModel::all());
        return $result;
    }
}
