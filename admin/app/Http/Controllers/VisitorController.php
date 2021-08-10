<?php

namespace App\Http\Controllers;

use App\VisitorModel;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function VisitorIndex()
    {
        $VisitorData = json_decode(VisitorModel::all());
        return view('Visitor', ['VisitorData' => $VisitorData]);
    }
}
