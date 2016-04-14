<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Peer to Peer Freight</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('pakages/bower_components/bootstrap/dist/css/bootstrap.css') }}">
    <style>
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            /* Set the fixed height of the footer here */
            height: 60px;
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row"><!-- whole page row -->
            <div class="col-md-10 col-md-offset-1">
                <div>
                    <h1>Peer to Peer Freight</h1>
                </div>
                <nav class="navbar navbar-default">
                    <ul class="nav navbar-nav">
                        <li><a href="/">Home</a> </li>
                        <li><a href="about">About</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        @if($isLoggedin)
                            <li><a>Welcome {{ $userType }}: {{ $userName }} </a></li>
                            <li><a href="auth/logout">Logout&nbsp;</a> </li>
                        @else
                            <li><a href="auth/login">Login &nbsp;</a> </li>
                        @endif
                    </ul>
                </nav>
                <hr>
                <div>
                    @yield('content')
                    @if($isLoggedin)
                        @if($userType == "Admin")

                        @elseif($userType == "Driver")

                        @elseif($userType == "Poster")
                            <!-- poster login display simple driverroutes, and -->
                            <h2>1.Driver Routes:</h2>
                            <p>Driver Routes table shows all the routes provided by all the drivers. As a loggedin user,
                            you can place an order for the driver with your price.</p>
                            <table class="table table-stripped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th><input type="hidden" name="driverroutid"></th>
                                    <th>Driver</th>
                                    <th>Route Start</th>
                                    <th>Route End</th>
                                    <th>Price</th>
                                    <th>Capacity</th>
                                    <th>Offered</th>
                                    <th>Your Price</th>
                                    <th>Place Order</th>
                                </tr>
                                </thead>
                                <tbody>
                                @for($i = 0; $i < count($driverroutes); $i++)
                                    <form action="addOrder" method="post">
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <input type="hidden" name="userid" value="{{ $userId }}"/>
                                        <th><input type="hidden" name="driverrouteid" value="{{ $driverroutes[$i]->driverrouteid }}" /></th>
                                        <th>{{ $driverroutes[$i]->drivername }}</th>
                                        <th>{{ $driverroutes[$i]->start }}</th>
                                        <th>{{ $driverroutes[$i]->end }}</th>
                                        <th>{{ $driverroutes[$i]->driverprice }}</th>
                                        <th>{{ $driverroutes[$i]->capacity }}</th>
                                        <th>{{ $driverroutes[$i]->offered }}</th>

                                        <th><input type="number" name="posterprice"/></th>
                                        <th><input type="button" class="btn btn-success" value="Order"/></th>
                                    </tr>
                                    </form>
                                @endfor
                                </tbody>
                            </table>
                            <hr>
                            <h2>2.Poster Orders</h2>
                            <p>Poster Orders table shows all the orders you have placed, you can cancel the orders
                            that are not started</p>
                            <table class="table table-stripped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th><input type="hidden" name="tripid"></th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>Driver</th>
                                    <th>Price</th>
                                    <th>Capacity</th>
                                    <th>Offered</th>
                                    <th>Status</th>
                                    <th>Order Date</th>
                                    <!--<th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Cancel?</th>-->
                                </tr>
                                </thead>
                                <tbody>
                                @for($i = 0; $i < count($userTrips); $i++)
                                    <form action="cancelOrder" method="post">
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <th><input type="hidden" name="trip" value="{{ $userTrips[$i]->tripid }}" /></th>
                                            <th>{{ $userTrips[$i]->start }}</th>
                                            <th>{{ $userTrips[$i]->end  }}</th>
                                            <th>{{ $userTrips[$i]->drivername  }}</th>
                                            <th>{{ $userTrips[$i]->posterprice }}</th>
                                            <th>{{ $userTrips[$i]->capacity  }}</th>
                                            <th>{{ $userTrips[$i]->offered }}</th>
                                            <th>{{ $userTrips[$i]->status }}</th>
                                            <!--<th>{{ $userTrips[$i]->requestdate }}</th>
                                            <th>{{ $userTrips[$i]->requestdate }}</th>
                                            <th>{{ $userTrips[$i]->startdate }}</th>-->
                                            @if($userTrips[$i]->status == "Ordered")
                                            <th><input type="button" class="btn btn-warning" value="Cancel"/></th>
                                                @else
                                                <th><input disabled="true" type="button" class="btn btn-warning" value="Cancel"/></th>
                                            @endif
                                        </tr>
                                    </form>
                                @endfor
                                </tbody>
                            </table>
                        @endif
                    @else
                        <!-- nologin display simple driverroutes, and -->
                        <h2>1.Driver Routes:</h2>
                        <p>Driver Routes table shows all the routes provided by all the drivers. All users(login or nologin)
                        can see the routes. But only users that are loggedin can place an order for the drivers</p>
                        <table class="table table-stripped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th><input type="hidden" name="driverroutid"></th>
                                <th>Driver Name</th>
                                <th>Route Start</th>
                                <th>Route End</th>
                                <th>Driver Price</th>
                                <th>Capacity</th>
                                <th>Offered</th>
                            </tr>
                            </thead>
                            <tbody>
                                @for($i = 0; $i < count($driverroutes); $i++)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <th><input type="hidden" name="driverrouteid" value="{{ $driverroutes[$i]->driverrouteid }}" /></th>
                                        <th>{{ $driverroutes[$i]->drivername }}</th>
                                        <th>{{ $driverroutes[$i]->start }}</th>
                                        <th>{{ $driverroutes[$i]->end }}</th>
                                        <th>{{ $driverroutes[$i]->driverprice }}</th>
                                        <th>{{ $driverroutes[$i]->capacity }}</th>
                                        <th>{{ $driverroutes[$i]->offered }}</th>
                                    </tr>

                                @endfor
                            </tbody>
                        </table>
                    @endif
                    @yield('content')
                </div>
                <hr>

            </div>
        </div>

    </div>
    <div style="margin-top:30px;">
    <footer class="footer">
        <div class="container" >
            <p class="text-muted">&copy; copyleft</p>
            <p class="text-muted">Proudly developed with <a href="http://laravel.com">Laravel</a>,
                themed by <a href="http://getbootstrap.com">BootStrap</a></p>
        </div>
    </footer>
    </div>
</body>
</html>