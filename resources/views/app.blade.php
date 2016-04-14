<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Peer to Peer Freight</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('pakages/bower_components/bootstrap/dist/css/bootstrap.css') }}">
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
                            <li><a>Welcome {{ $userType }}: {{ $userName }} &nbsp;</a></li>
                        @else
                            <li><a href="auth/login">Login &nbsp;</a> </li>
                        @endif
                    </ul>
                </nav>
                <div>
                    @yield('content')
                </div>
                <div>
                    footer here
                </div>
            </div>
        </div>
    </div>
</body>
</html>