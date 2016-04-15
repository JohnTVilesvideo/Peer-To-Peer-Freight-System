@extends("app")

@section("content")
        <!-- nologin display simple driverroutes, and -->
<h2>1.Driver Routes:</h2>
<p>Your Routes table shows all the routes provided by you. You can delete or edit or add new routes</p>
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
            <form>
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $driverroutes[$i]->drivername }}</td>
                    <td>{{ $driverroutes[$i]->start }}</td>
                    <td>{{ $driverroutes[$i]->end }}</td>
                    <td><input type="number" style="width:50px;" value="{{ $driverroutes[$i]->driverprice }}" name="price" /> </td>
                    <td><input type="text" style="width:70px;" name="capacity" value="{{ $driverroutes[$i]->capacity }}"</td>
                    <td><input type="radio" id="offered{{ $i }}" name="offered" value="YES" {{ $driverroutes[$i]->offered == "YES" ? "checked" : "" }}/>
                        <label for="offered{{ $i }}">YES</label>
                        <input type="radio" id="unoffered{{ $i }}" name="offered" value="NO" {{ $driverroutes[$i]->offered == "NO" ? "checked" : "" }}/>
                        <label for="unoffered{{ $i }}">NO</label>
                    </td>
                        <input type="hidden" name="userid" value="{{ $userId }}"/>
                        <input type="hidden" name="driverrouteid" value="{{ $driverroutes[$i]->driverrouteid }}" />
                        <td><input type="button" class="btn btn-success" formaction="ModifyYourRoute" formmethod="post" value="Modify"/>
                            <input type="button" class="btn btn-warning" formaction="DeleteYourRoute" formmethod="post" value="Delete"/>
                        </td>
                </tr>
            </form>
    @endfor
    </tbody>
</table>
<h2>2.Add Route:</h2>
<p>You can add a route with following form</p>
<form action="AddRoute" method="post">
    <label style="width:80px;text-align: right;">Route:</label>
    <select name="routeid">
        @foreach($routs as $rout)
            <option value="{{ $rout->id }}">
                {{ $rout->start }}->{{ $rout->end }}
            </option>
        @endforeach
    </select><br>
    <label style="width:80px;text-align: right;">Price:</label><input type="number" name="price" /><br>
    <label style="width:80px;text-align: right;">Capacity:</label><input type="text" name="capacity"/><br>
    <label style="width:80px;text-align: right;">Offered:</label><input type="radio" id="offered" name="offered" value="YES"/> <label for="offered">YES</label>
    <input type="radio" id="unoffered" name="offered" value="NO"/> <label for="unoffered">NO</label><br>
    <input type="submit" class="btn btn-success" value="Add" style="margin-left: 80px;"/>
</form>
@endsection