<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    public function getIndex()
    {
        echo "hi";
        return;
        if(Auth::check() && $user = Auth::user()) {

        }
        $isLoggedin = false;
        $userType = "Driver";
        $userName = "Anna";
        return view("index", compact("isLoggedin", "userType", "userName"));
    }
}
