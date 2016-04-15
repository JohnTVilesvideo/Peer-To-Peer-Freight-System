@extends("app")

@section("content")
        <!-- nologin display simple driverroutes, and -->
<h2>1.Driver Routes:</h2>
<p>Driver Routes table shows all the routes provided by all the drivers. All users(login or nologin)
    can see the routes. But only users that are loggedin can place an order for the drivers</p>
<table class="table table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th>Driver Name</th>
        <th>Route Start</th>
        <th>Route End</th>
        <th>Driver Price</th>
        <th>Capacity</th>
        <th>Offered</th>
        @if($isLoggedin and $userType == "Poster")
            <th>Your Price</th>
            <th>Place Order</th>
            @endif
    </tr>
    </thead>
    <tbody>
    @for($i = 0; $i < count($driverroutes); $i++)
        @if($isLoggedin and $userType == "Poster")
            <form action="placeOrder" method="post">
         @endif
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $driverroutes[$i]->drivername }}</td>
            <td>{{ $driverroutes[$i]->start }}</td>
            <td>{{ $driverroutes[$i]->end }}</td>
            <td>{{ $driverroutes[$i]->driverprice }}</td>
            <td>{{ $driverroutes[$i]->capacity }}</td>
            <td>{{ $driverroutes[$i]->offered }}</td>
            @if($isLoggedin and $userType == "Poster")
                <input type="hidden" name="userid" value="{{ $userId }}"/>
                <input type="hidden" name="driverrouteid" value="{{ $driverroutes[$i]->driverrouteid }}" />
                <td><input type="number" style="width: 50px;" name="posterprice" /></td>
                <td><input type="submit" class="btn btn-success" value="Order"> </td>
             @endif
        </tr>
        @if($isLoggedin and $userType == "Poster")
        </form>
        @endif
    @endfor
    </tbody>
</table>
@endsection