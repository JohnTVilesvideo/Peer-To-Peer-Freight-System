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
                        @if($isLoggedin)
                            @if($userType == "Poster")
                                <li><a href="/">DriverRoutes</a> </li>
                                <li><a href="posterorders">PosterOrders</a></li>
                                <li><a href="about">About</a></li>
                            @elseif($userType == "Driver")
                                <li><a href="/">DriverRoutes</a> </li>
                                <li><a href="yourroutes">YourRoutes</a></li>
                                <li><a href="yourorders">YourOrders</a> </li>
                                <li><a href="about">About</a></li>
                            @elseif($userType == "Admin")
                                <li><a href="/">DriverRoutes</a> </li>
                                <li><a href="users">Users</a></li>
                                <li><a href="routs">Routes</a> </li>
                                <li><a href="about">About</a></li>
                            @endif
                        @else
                            <li><a href="/">DriverRoutes</a> </li>
                            <li><a href="about">About</a></li>
                        @endif
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