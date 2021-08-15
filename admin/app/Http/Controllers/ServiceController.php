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


    public function ServiceDelete(Request $request)
    {
        $id = $request->input('id');

        $result = ServiceModel::where('id', '=', $id)->delete();

        if ($result == true) {
            return 1;
        } else {
            return 0;
        }
    }


    public function getServiceDetails(Request $request)
    {
        $id = $request->input('id');
        $result = json_encode(ServiceModel::where('id', '=', $id)->get());
        return $result;
    }



    public function ServiceUpdate(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $des = $request->input('des');
        $img = $request->input('img');
        $result = ServiceModel::where('id', '=', $id)->update(['service_name' => $name, 'service_des' => $des, 'service_img' => $img]);
        if ($result == true) {
            return 1;
        } else {
            return 0;
        }
    }


    //service add

    public function ServiceAdd(Request $request)
    {
        $name = $request->input('name');
        $des = $request->input('des');
        $img = $request->input('img');
        $result = ServiceModel::insert(['service_name' => $name, 'service_des' => $des, 'service_img' => $img]);
        if ($result == true) {
            return 1;
        } else {
            return 0;
        }
    }
}
