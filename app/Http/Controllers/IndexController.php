<?php

namespace App\Http\Controllers;

use App\Driverroute;
use App\Trip;
use App\User;
use App\Rout;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\Array_;

class IndexController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
    }
    private $test = 0;
    private $login = 1;
    public function getIndex()
    {
        if(Auth::check() && $user = Auth::user()) {
        /*if($this->login){
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
            }*/
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
        if(Auth::check() && $user = Auth::user()) {
        /*if($this->login){
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
            }*/
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
        if(Auth::check() && $user = Auth::user()) {
        /*if($this->login){
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
            }*/
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
            return Redirect::to("login");
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
        if(Auth::check() && $user = Auth::user()) {
        /*if($this->login){
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
            }*/
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
            return Redirect::to("login");
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
        if(Auth::check() && $user = Auth::user()) {
        /*if($this->login){
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
            }*/
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
            return Redirect::to("login");
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
            $userTrips[$i]->postername = User::find($dataTrips[$i]->userid)->name;
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
        if(Auth::check() && $user = Auth::user()) {
        /*if($this->login){
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
            }*/
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
            return Redirect::to("login");
        }
        $users = User::all();
        return view("users", compact("isLoggedin", "userType", "userName", "userId", "users"));
    }
    public function getRoutes()
    {
        if(Auth::check() && $user = Auth::user()) {
        /*if($this->login){
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
            }*/
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
            return Redirect::to("login");
        }
        $routs = Rout::all();
        return view("routs", compact("isLoggedin", "userType", "userName", "userId", "routs"));
    }
    //poster can cancel order
    public function postCancelOrder()
    {
        if(Auth::check() && $user = Auth::user()) {
        /*if($this->login){
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
            }*/
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
            return Redirect::to("login");
        }
        $input = Input::all();
        if($input['userid'] != $userId){
            $errorMsg = "Wrong User!";
            return view("error", compact("isLoggedin", "userId", "userName", "userType", "errorMsg"));
        }
        $trip = Trip::find($input['trip']);
        if($trip && $trip->userid == $input['userid'])
        {
            $trip->delete();
            return Redirect::to("posterorders");
        }
        else{
            $errorMsg = "No such trip found or login user error!";
            return view("error", compact("isLoggedin", "userId", "userName", "userType", "errorMsg"));
        }
    }
    //poster place order
    public function postPlaceOrder()
    {
        if(Auth::check() && $user = Auth::user()) {
        /*if($this->login){
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
            }*/
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
            return Redirect::to("login");
        }
        $input = Input::all();
        if($input['userid'] != $userId){
            $errorMsg = "Wrong User!";
            return view("error", compact("isLoggedin", "userId", "userName", "userType", "errorMsg"));
        }

        $trip = new Trip();
        $trip->userid = $input['userid'];
        $trip->driverrouteid = $input['driverrouteid'];
        if(!$input['posterprice']){
            $trip->posterprice = Driverroute::find($input['driverrouteid'])->price;
            //echo $trip->posterprice;
            //$trip->price =       Driverroute::find($input['driverrouteid'])->price;

        }
        $trip->status = 0;
        $trip->feedback = $input['feedback'];
        $trip->requestdate = Carbon::now();
        $trip->save();
        return Redirect::to("posterorders");
    }
    //modify price capacity offered
    public function postModifyDriverRoutes()
    {
        if(Auth::check() && $user = Auth::user()) {
        /*if($this->login){
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
            }*/
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
            return Redirect::to("login");
        }

        $input = Input::all();
        if($input['userid'] != $userId){
            $errorMsg = "Wrong User!";
            return view("error", compact("isLoggedin", "userId", "userName", "userType", "errorMsg"));
        }
        if(!$input['capacity']){
            $errorMsg = "Wrong Capacity!";
            return view("error", compact("isLoggedin", "userId", "userName", "userType", "errorMsg"));
        }
        if(! is_numeric($input['price'])){
            $errorMsg = "Wrong price!";
            return view("error", compact("isLoggedin", "userId", "userName", "userType", "errorMsg"));
        }
        $rout = Driverroute::find($input['driverrouteid']);
        if(!$rout)
        {
            $errorMsg = "No such route found!";
            return view("error", compact("isLoggedin", "userId", "userName", "userType", "errorMsg"));
        }
        $rout->offered = $input['offered'] == "YES" ? "1" : "0";
        $rout->capacity = $input['capacity'];
        $rout->price = $input['price'];
        $rout->save();
        return Redirect::to("yourroutes");
    }
    public function postDeleteDriverRoutes()
    {
        if(Auth::check() && $user = Auth::user()) {
        /*if($this->login){
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
            }*/
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
            return Redirect::to("login");
        }
        $input = Input::all();
        if($input['userid'] != $userId){
            $errorMsg = "Wrong User!";
            return view("error", compact("isLoggedin", "userId", "userName", "userType", "errorMsg"));
        }
        $rout = Driverroute::find($input['driverrouteid']);
        if(!$rout)
        {
            $errorMsg = "No such driver route found!";
            return view("error", compact("isLoggedin", "userId", "userName", "userType", "errorMsg"));
        }
        Trip::where("driverrouteid", $input['driverrouteid'])->delete();
        $rout->delete();
        return Redirect::to("yourroutes");
    }
    public function postAddDriverRoutes()
    {
if(Auth::check() && $user = Auth::user()) {
        /*if($this->login){
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
            }*/
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
            return Redirect::to("login");
        }

        $input = Input::all();
        if($input['userid'] != $userId){
            $errorMsg = "Wrong User!";
            return view("error", compact("isLoggedin", "userId", "userName", "userType", "errorMsg"));
        }
        if(!$input['capacity']){
            $errorMsg = "Wrong Capacity!";
            return view("error", compact("isLoggedin", "userId", "userName", "userType", "errorMsg"));
        }
        if(! is_numeric($input['price'])){
            $errorMsg = "Wrong price!";
            return view("error", compact("isLoggedin", "userId", "userName", "userType", "errorMsg"));
        }
        $rout = new Driverroute();
        $rout->offered = $input['offered'] == "YES" ? "1" : "0";
        $rout->capacity = $input['capacity'];
        $rout->price = $input['price'];
        $rout->routeid = $input['routeid'];
        $rout->driverid = $input['userid'];
        $rout->save();
        return Redirect::to("yourroutes");
    }
    public function postRejectOrder()
    {
        if(Auth::check() && $user = Auth::user()) {
        /*if($this->login){
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
            }*/
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
            return Redirect::to("login");
        }

        $input = Input::all();
        if($input['userid'] != $userId){
            $errorMsg = "Wrong User!";
            return view("error", compact("isLoggedin", "userId", "userName", "userType", "errorMsg"));
        }
        $trip = Trip::find($input['trip']);
        if(!$trip){
            $errorMsg = "No such order found!";
            return view("error", compact("isLoggedin", "userId", "userName", "userType", "errorMsg"));
        }
        $trip->status = 3;
        $trip->save();
        return Redirect::to("yourorders");
    }
    public function postStartOrder()
    {
        if(Auth::check() && $user = Auth::user()) {
        /*if($this->login){
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
            }*/
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
            return Redirect::to("login");
        }

        $input = Input::all();
        if($input['userid'] != $userId){
            $errorMsg = "Wrong User!";
            return view("error", compact("isLoggedin", "userId", "userName", "userType", "errorMsg"));
        }
        $trip = Trip::find($input['trip']);
        if(!$trip){
            $errorMsg = "No such order found!";
            return view("error", compact("isLoggedin", "userId", "userName", "userType", "errorMsg"));
        }
        $trip->status = 1;
        $trip->save();
        return Redirect::to("yourorders");
    }
    public function postEndOrder()
    {
        if(Auth::check() && $user = Auth::user()) {
        /*if($this->login){
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
            }*/
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
            return Redirect::to("login");
        }

        $input = Input::all();
        if($input['userid'] != $userId){
            $errorMsg = "Wrong User!";
            return view("error", compact("isLoggedin", "userId", "userName", "userType", "errorMsg"));
        }
        $trip = Trip::find($input['trip']);
        if(!$trip){
            $errorMsg = "No such order found!";
            return view("error", compact("isLoggedin", "userId", "userName", "userType", "errorMsg"));
        }
        $trip->status = 2;
        $trip->save();
        return Redirect::to("yourorders");
    }
    public function postAdminAddUser()
    {
        if(Auth::check() && $user = Auth::user()) {
        /*if($this->login){
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
            }*/
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
            return Redirect::to("login");
        }

        $input = Input::all();
        if($input['loginuserid'] != $userId){
            $errorMsg = "Wrong Login User!";
            return view("error", compact("isLoggedin", "userId", "userName", "userType", "errorMsg"));
        }
        if(!filter_var($input['email'], FILTER_VALIDATE_EMAIL))
        {
            $errorMsg = "Wrong email format!";
            return view("error", compact("isLoggedin", "userId", "userName", "userType", "errorMsg"));
        }
        if(!$input['name'])
        {
            $errorMsg = "Invalid name!";
            return view("error", compact("isLoggedin", "userId", "userName", "userType", "errorMsg"));
        }
        if(!$input['password'] || strlen($input['password']) < 6){
            $errorMsg = "Password need to be 6 bytes or more!";
            return view("error", compact("isLoggedin", "userId", "userName", "userType", "errorMsg"));
        }
        $user = new User();
        $user->email = $input['email'];
        $user->name = $input['name'];
        $user->password = bcrypt($input['password']);
        $user->type = $input['type'];
        $user->save();
        return Redirect::to("users");
    }
    public function postAdminModifyUser()
    {
        if(Auth::check() && $user = Auth::user()) {
        /*if($this->login){
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
            }*/
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
            return Redirect::to("login");
        }

        $input = Input::all();
        if($input['loginuserid'] != $userId){
            $errorMsg = "Wrong Login User!";
            return view("error", compact("isLoggedin", "userId", "userName", "userType", "errorMsg"));
        }
        if(!filter_var($input['email'], FILTER_VALIDATE_EMAIL))
        {
            $errorMsg = "Wrong email format!";
            return view("error", compact("isLoggedin", "userId", "userName", "userType", "errorMsg"));
        }
        if(!$input['name'])
        {
            $errorMsg = "Invalid name!";
            return view("error", compact("isLoggedin", "userId", "userName", "userType", "errorMsg"));
        }
        $user = User::find($input['userid']);
        if(!$user)
        {
            $errorMsg = "No such user found!";
            return view("error", compact("isLoggedin", "userId", "userName", "userType", "errorMsg"));
        }
        $user->email = $input['email'];
        $user->name = $input['name'];
        if($input['password'] && strlen($input['password']) < 6){
            $errorMsg = "Password need to be 6 bytes or more!";
            return view("error", compact("isLoggedin", "userId", "userName", "userType", "errorMsg"));
        }
        if($input['password']) {
            $user->password = bcrypt($input['password']);
        }
        $user->save();
        return Redirect::to("users");
    }
    public function postDeleteUser()
    {
        if(Auth::check() && $user = Auth::user()) {
        /*if($this->login){
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
            }*/
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
            return Redirect::to("login");
        }

        $input = Input::all();
        if($input['loginuserid'] == $input['userid']){
            $errorMsg = "You can't delete the current login user!";
            return view("error", compact("isLoggedin", "userId", "userName", "userType", "errorMsg"));
        }
        if($input['loginuserid'] != $userId){
            $errorMsg = "Wrong Login User!";
            return view("error", compact("isLoggedin", "userId", "userName", "userType", "errorMsg"));
        }
        $user = User::find($input['userid']);
        if(!$user)
        {
            $errorMsg = "No such user found!";
            return view("error", compact("isLoggedin", "userId", "userName", "userType", "errorMsg"));
        }
        if($user->type == 1)
        {
            $driverroutes = Driverroute::where("driverid", $user->id)->get();
            foreach ($driverroutes as $driverroute)
            {
                Trip::where("driverrouteid", $driverroute->id)->delete();
            }
            Driverroute::where("driverid", $user->id)->delete();
            $user->delete();
        }
        elseif ($user->type == 2)
        {
            Trip::where("userid", $user->id)->delete();
            $user->delete();
        }
        else{
            $user->delete();
        }
        return Redirect::to("users");
    }
    public function postAddRoute()
    {
        if(Auth::check() && $user = Auth::user()) {
        /*if($this->login){
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
            }*/
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
            return Redirect::to("login");
        }

        $input = Input::all();
        if($input['userid'] != $userId){
            $errorMsg = "Wrong Login User!";
            return view("error", compact("isLoggedin", "userId", "userName", "userType", "errorMsg"));
        }
        if(!$input['start'])
        {
            $errorMsg = "Invalid Start!";
            return view("error", compact("isLoggedin", "userId", "userName", "userType", "errorMsg"));
        }
        if(!$input['end'])
        {
            $errorMsg = "Invalid End!";
            return view("error", compact("isLoggedin", "userId", "userName", "userType", "errorMsg"));
        }
        $rout = new Rout();
        $rout->start = $input['start'];
        $rout->end = $input['end'];
        $rout->save();
        return Redirect::to("routs");
    }
    public function postAdminDeleteRoute()
    {
        if(Auth::check() && $user = Auth::user()) {
        /*if($this->login){
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
            }*/
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
            return Redirect::to("login");
        }

        $input = Input::all();
        if($input['userid'] != $userId){
            $errorMsg = "Wrong Login User!";
            return view("error", compact("isLoggedin", "userId", "userName", "userType", "errorMsg"));
        }
        $rout = Rout::find($input['routeid']);
        if(!$rout)
        {
            $errorMsg = "No Such Route Found!";
            return view("error", compact("isLoggedin", "userId", "userName", "userType", "errorMsg"));
        }
        $driverroutes = Driverroute::where("routeid", $rout->id)->get();
        foreach ($driverroutes as $driverroute)
        {
            Trip::where("driverrouteid", $driverroute->id)->delete();
        }
        Driverroute::where("routeid", $rout->id)->delete();
        $rout->delete();
        return Redirect::to("routs");

    }
    public function postAdminModifyRoute()
    {
        if(Auth::check() && $user = Auth::user()) {
        /*if($this->login){
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
            }*/
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
            return Redirect::to("login");
        }

        $input = Input::all();
        if($input['userid'] != $userId){
            $errorMsg = "Wrong Login User!";
            return view("error", compact("isLoggedin", "userId", "userName", "userType", "errorMsg"));
        }
        if(!$input['start'])
        {
            $errorMsg = "Invalid Start!";
            return view("error", compact("isLoggedin", "userId", "userName", "userType", "errorMsg"));
        }
        if(!$input['end'])
        {
            $errorMsg = "Invalid End!";
            return view("error", compact("isLoggedin", "userId", "userName", "userType", "errorMsg"));
        }
        $rout = Rout::find($input['routeid']);
        if(!$rout)
        {
            $errorMsg = "No Such Route Found!";
            return view("error", compact("isLoggedin", "userId", "userName", "userType", "errorMsg"));
        }
        $rout->start = $input['start'];
        $rout->end = $input['end'];
        $rout->save();
        return Redirect::to("routs");
    }
}
