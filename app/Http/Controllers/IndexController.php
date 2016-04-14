<?php

namespace App\Http\Controllers;

use App\Driverroute;
use App\Trip;
use App\User;
use App\Rout;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\Array_;

class IndexController extends Controller
{
    public function getIndex()
    {
        //if(Auth::check() && $user = Auth::user()) {
        if(1){
            $user = new User();
            $user->name = "Anna";
            $user->type = 2;
            $user->id = 3;
            $isLoggedin = true;
            if($user->type == 0) $userType = "Admin";
            elseif ($user->type == 1) $userType = "Driver";
            elseif ($user->type == 2) $userType = "Poster";
            else return abort(404);
            $userName = $user->name;
            $userId = $user->id;
            //get driver routes
            $data = Driverroute::all();
            $driverroutes = $data;
            for($i = 0; $i < count($data); $i++)
            {
                $driverroutes[$i]->driverrouteid = $data[$i]->id;
                $driverroutes[$i]->drivername =  User::find($data[$i]->driverid)->name;
                $driverroutes[$i]->start = Rout::find($data[$i]->routeid)->start;
                $driverroutes[$i]->end = Rout::find($data[$i]->routeid)->end;
                $driverroutes[$i]->driverprice = $data[$i]->price;
                $driverroutes[$i]->capacity = $data[$i]->capacity;
                $driverroutes[$i]->offered = $data[$i]->offered == 1 ? "YES" : "NO";
            }
            //get user trips
            $dataTrips = Trip::where("userid", $userId)->get();

            $userTrips = $dataTrips;
            for($i = 0; $i < count($dataTrips); $i++)
            {
                $userTrips[$i]->tripid = $dataTrips[$i]->id;
                $userTrips[$i]->start = Rout::find(Driverroute::find($dataTrips[$i]->driverrouteid)->routeid)->start;
                $userTrips[$i]->end = Rout::find(Driverroute::find($dataTrips[$i]->driverrouteid)->routeid)->end;
                $userTrips[$i]->drivername = User::find(Driverroute::find($dataTrips[$i]->driverrouteid)->driverid)->name;
                $userTrips[$i]->posterprice = $dataTrips[$i]->posterprice;
                $userTrips[$i]->capacity = Driverroute::find($dataTrips[$i]->driverrouteid)->capacity;
                $userTrips[$i]->offered = Driverroute::find($dataTrips[$i]->driverrouteid)->offered ? "YES" : "NO";
                $tripStatus = $dataTrips[$i]->status;
                if ($tripStatus == 0) $userTrips[$i]->status = "Ordered";
                else if($tripStatus == 1) $userTrips[$i]->status = "Started";
                else  $userTrips[$i]->status = "Ended";
                $userTrips[$i]->requestdate = $dataTrips[$i]->requestdate;
                $userTrips[$i]->startdate = $dataTrips[$i]-> startdate;
                $userTrips[$i]->enddate = $dataTrips[$i]->enddate;
            }
            return view("index", compact("isLoggedin", "userType", "userName", "userId", "userTrips", "driverroutes"));
        }
        else{
            $isLoggedin = false;
            $data = Driverroute::all();
            $driverroutes = $data;
            for($i = 0; $i < count($data); $i++)
            {
                $driverroutes[$i]->driverrouteid = $data[$i]->id;
                $driverroutes[$i]->drivername =  User::find($data[$i]->driverid)->name;
                $driverroutes[$i]->start = Rout::find($data[$i]->routeid)->start;
                $driverroutes[$i]->end = Rout::find($data[$i]->routeid)->end;
                $driverroutes[$i]->driverprice = $data[$i]->price;
                $driverroutes[$i]->capacity = $data[$i]->capacity;
                $driverroutes[$i]->offered = $data[$i]->offered == 1 ? "YES" : "NO";
            }
            return view("index", compact("isLoggedin", "driverroutes"));/*
            $driverroutes[$i]->driverrouteid
$driverroutes[$i]->drivername }}
$driverroutes[$i]->start }}</th>
$driverroutes[$i]->end }}</th>
$driverroutes[$i]->driverprice }
$driverroutes[$i]->capacity }}</
$driverroutes[$i]->offered }}</t*/
        }
    }
    public function getAbout()
    {
        return view("about");
    }
    public function getPosterOrders()
    {

    }
    public function getYourRoutes()
    {

    }
    public function getDriverOrders()
    {

    }
    public function getUsers()
    {

    }
    public function getRoute()
    {

    }
    //poster can cancel order
    public function postCancelOrder()
    {

    }
    //modify price capacity offered
    public function postModifyDriverRoutes()
    {

    }
    public function postDeleteDriverRoutes()
    {

    }
    public function postAddDriverRoutes()
    {

    }
    public function postDriverChangeOrderStatus()
    {

    }
    public function postAdminAddUser()
    {

    }
    public function postAdminModifyUser()
    {

    }
    public function postDeleteUser()
    {

    }
    public function postAddRoute()
    {

    }
}
