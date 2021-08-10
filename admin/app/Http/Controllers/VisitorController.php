<?php

namespace App\Http\Controllers;

use App\VisitorModel;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function VisitorIndex()
    {
        $VisitorData = json_decode(VisitorModel::orderBy('id', 'desc')->take(5)->get());
        return view('Visitor', ['VisitorData' => $VisitorData]);
    }
}
