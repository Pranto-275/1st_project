<?php

namespace App\Http\Controllers;

use App\AdminModel;
use Illuminate\Http\Request;

class loginController extends Controller
{

    public function loginFunction()
    {
        return view('Login');
    }

    public function onLogin(Request $request)
    {
        $user = $request->input('user');
        $pass = $request->input('pass');

        $countValue = AdminModel::where('usename', '=', $user)->where('password', '=', $pass)->count();
        if ($countValue == 1) {

            $request->session()->put('user', $user);

            return 1;
        } else {
            return 0;
        }
    }


    //onlogout
    public function onLogout(Request $request)
    {
        $request->session()->flush();
        return redirect('/Login');
    }
}
