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
}
