<?php

namespace App\Http\Controllers;

use App\Driverroute;
use App\Trip;
use App\User;
use App\Rout;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\Array_;

class IndexController extends Controller
{
    private $test = 0;
    private $login = 1;
    public function getIndex()
    {
        //if(Auth::check() && $user = Auth::user()) {
        if($this->login){
            $user = new User();
            if($this->test == 0)
            {
                $user->name = "Ben";
                $user->type = 0;
                $user->id = 1;
            }
            elseif ($this->test == 1)
            {
                $user->name = "Mick";
                $user->type = 1;
                $user->id = 2;
            }
            elseif($this->test == 2)
            {
                $user->name = "Anna";
                $user->type = 2;
                $user->id = 3;
            }
            $isLoggedin = true;
            if($user->type == 0) $userType = "Admin";
            elseif ($user->type == 1) $userType = "Driver";
            elseif ($user->type == 2) $userType = "Poster";
            else return abort(404);
            $userName = $user->name;
            $userId = $user->id;
        }
        else{
            $isLoggedin = false;
        }
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
        if($isLoggedin)
            return view("index", compact("isLoggedin", "driverroutes", "userType", "userName", "userId"));
        else
            return view("index", compact("isLoggedin", "driverroutes"));
    }
    public function getAbout()
    {
        //if(Auth::check() && $user = Auth::user()) {
        if($this->login){
            $user = new User();
            if($this->test == 0)
            {
                $user->name = "Ben";
                $user->type = 0;
                $user->id = 1;
            }
            elseif ($this->test == 1)
            {
                $user->name = "Mick";
                $user->type = 1;
                $user->id = 2;
            }
            elseif($this->test == 2)
            {
                $user->name = "Anna";
                $user->type = 2;
                $user->id = 3;
            }
            $isLoggedin = true;
            if($user->type == 0) $userType = "Admin";
            elseif ($user->type == 1) $userType = "Driver";
            elseif ($user->type == 2) $userType = "Poster";
            else return abort(404);
            $userName = $user->name;
            $userId = $user->id;
        }
        else{
            $isLoggedin = false;
        }
        if ($isLoggedin)
            return view("about",compact("isLoggedin", "driverroutes", "userType", "userName", "userId"));
        else
            return view("about", compact("isLoggedin"));
    }
    public function getPosterOrders()
    {
        //if(Auth::check() && $user = Auth::user()) {
        if($this->login){
            $user = new User();
            if($this->test == 0)
            {
                $user->name = "Ben";
                $user->type = 0;
                $user->id = 1;
            }
            elseif ($this->test == 1)
            {
                $user->name = "Mick";
                $user->type = 1;
                $user->id = 2;
            }
            elseif($this->test == 2)
            {
                $user->name = "Anna";
                $user->type = 2;
                $user->id = 3;
            }
            $isLoggedin = true;
            if($user->type == 0) $userType = "Admin";
            elseif ($user->type == 1) $userType = "Driver";
            elseif ($user->type == 2) $userType = "Poster";
            else return abort(404);
            $userName = $user->name;
            $userId = $user->id;
        }
        else{
            $isLoggedin = false;
            return Redirect::to("auth/login");
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
        return view("posterorders", compact("isLoggedin", "userType", "userName", "userId", "userTrips"));
    }
    public function getYourRoutes()
    {
        //if(Auth::check() && $user = Auth::user()) {
        if($this->login){
            $user = new User();
            if($this->test == 0)
            {
                $user->name = "Ben";
                $user->type = 0;
                $user->id = 1;
            }
            elseif ($this->test == 1)
            {
                $user->name = "Mick";
                $user->type = 1;
                $user->id = 2;
            }
            elseif($this->test == 2)
            {
                $user->name = "Anna";
                $user->type = 2;
                $user->id = 3;
            }
            $isLoggedin = true;
            if($user->type == 0) $userType = "Admin";
            elseif ($user->type == 1) $userType = "Driver";
            elseif ($user->type == 2) $userType = "Poster";
            else return abort(404);
            $userName = $user->name;
            $userId = $user->id;
        }
        else{
            $isLoggedin = false;
            return Redirect::to("auth/login");
        }
        $data = Driverroute::where("driverid", $userId)->get();
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
        $routs = Rout::all();
        return view("yourroutes", compact("isLoggedin", "driverroutes", "userType", "userId", "userName", "routs"));
    }
    public function getDriverOrders()
    {
        //if(Auth::check() && $user = Auth::user()) {
        if($this->login){
            $user = new User();
            if($this->test == 0)
            {
                $user->name = "Ben";
                $user->type = 0;
                $user->id = 1;
            }
            elseif ($this->test == 1)
            {
                $user->name = "Mick";
                $user->type = 1;
                $user->id = 2;
            }
            elseif($this->test == 2)
            {
                $user->name = "Anna";
                $user->type = 2;
                $user->id = 3;
            }
            $isLoggedin = true;
            if($user->type == 0) $userType = "Admin";
            elseif ($user->type == 1) $userType = "Driver";
            elseif ($user->type == 2) $userType = "Poster";
            else return abort(404);
            $userName = $user->name;
            $userId = $user->id;
        }
        else{
            $isLoggedin = false;
            return Redirect::to("auth/login");
        }
        // get driver routes
        $driverroutes = Driverroute::where("driverid", $userId)->get();
        //get driver trips
        $dataTrips = array();
        foreach ($driverroutes as $driverroute)
        {
            $trips = Trip::where("driverrouteid", $driverroute->id)->get();
            foreach ($trips as $trip)
            {
                array_push($dataTrips, $trip);
            }
            //$dataTrips = array_merge($dataTrips, $trips);
        }

        $userTrips = $dataTrips;
        for($i = 0; $i < count($dataTrips); $i++)
        {
            $userTrips[$i]->tripid = $dataTrips[$i]->id;
            $userTrips[$i]->start = Rout::find(Driverroute::find($dataTrips[$i]->driverrouteid)->routeid)->start;
            $userTrips[$i]->end = Rout::find(Driverroute::find($dataTrips[$i]->driverrouteid)->routeid)->end;
            $userTrips[$i]->drivername = User::find(Driverroute::find($dataTrips[$i]->driverrouteid)->driverid)->name;
            $userTrips[$i]->posterprice = $dataTrips[$i]->posterprice;
            $userTrips[$i]->capacity = Driverroute::find($dataTrips[$i]->driverrouteid)->capacity;
            $userTrips[$i]->yourprice = Driverroute::find($dataTrips[$i]->driverrouteid)->price;
            $userTrips[$i]->offered = Driverroute::find($dataTrips[$i]->driverrouteid)->offered ? "YES" : "NO";
            $tripStatus = $dataTrips[$i]->status;
            if ($tripStatus == 0) $userTrips[$i]->status = "Ordered";
            else if($tripStatus == 1) $userTrips[$i]->status = "Started";
            else  $userTrips[$i]->status = "Ended";
            $userTrips[$i]->requestdate = $dataTrips[$i]->requestdate;
            $userTrips[$i]->startdate = $dataTrips[$i]-> startdate;
            $userTrips[$i]->enddate = $dataTrips[$i]->enddate;
        }
        return view("driverorders", compact("isLoggedin", "userType", "userName", "userId", "userTrips"));
    }
    public function getUsers()
    {
        //if(Auth::check() && $user = Auth::user()) {
        if($this->login){
            $user = new User();
            if($this->test == 0)
            {
                $user->name = "Ben";
                $user->type = 0;
                $user->id = 1;
            }
            elseif ($this->test == 1)
            {
                $user->name = "Mick";
                $user->type = 1;
                $user->id = 2;
            }
            elseif($this->test == 2)
            {
                $user->name = "Anna";
                $user->type = 2;
                $user->id = 3;
            }
            $isLoggedin = true;
            if($user->type == 0) $userType = "Admin";
            elseif ($user->type == 1) $userType = "Driver";
            elseif ($user->type == 2) $userType = "Poster";
            else return abort(404);
            $userName = $user->name;
            $userId = $user->id;
        }
        else{
            $isLoggedin = false;
            return Redirect::to("auth/login");
        }
        $users = User::all();
        return view("users", compact("isLoggedin", "userType", "userName", "userId", "users"));
    }
    public function getRoutes()
    {
        //if(Auth::check() && $user = Auth::user()) {
        if($this->login){
            $user = new User();
            if($this->test == 0)
            {
                $user->name = "Ben";
                $user->type = 0;
                $user->id = 1;
            }
            elseif ($this->test == 1)
            {
                $user->name = "Mick";
                $user->type = 1;
                $user->id = 2;
            }
            elseif($this->test == 2)
            {
                $user->name = "Anna";
                $user->type = 2;
                $user->id = 3;
            }
            $isLoggedin = true;
            if($user->type == 0) $userType = "Admin";
            elseif ($user->type == 1) $userType = "Driver";
            elseif ($user->type == 2) $userType = "Poster";
            else return abort(404);
            $userName = $user->name;
            $userId = $user->id;
        }
        else{
            $isLoggedin = false;
            return Redirect::to("auth/login");
        }
        $routs = Rout::all();
        return view("routs", compact("isLoggedin", "userType", "userName", "userId", "routs"));
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
