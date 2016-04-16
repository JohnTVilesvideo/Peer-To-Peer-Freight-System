@extends("app")

@section("content")
    <h2>Your Orders</h2>
    <p>Your Orders table shows all the orders you have, you can accept an order, start order or delete order</p>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Start</th>
            <th>End</th>
            <th>Driver</th>
            <th>Price</th>
            <th>Capacity</th>
            <th>Offered</th>
            <th>Status</th>
            <th>Poster Price</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @for($i = 0; $i < count($userTrips); $i++)
            <form>
                <tr>
                    {{ csrf_field() }}
                    <td>{{ $i + 1 }}</td>
                    <input type="hidden" name="trip" value="{{ $userTrips[$i]->tripid }}" />
                    <input type="hidden" name="userid" value="{{ $userId }}"/>
                    <td>{{ $userTrips[$i]->start }}</td>
                    <td>{{ $userTrips[$i]->end  }}</td>
                    <td>{{ $userTrips[$i]->drivername  }}</td>
                    <td>{{ $userTrips[$i]->yourprice }}</td>
                    <td>{{ $userTrips[$i]->capacity  }}</td>
                    <td>{{ $userTrips[$i]->offered }}</td>
                    <td>{{ $userTrips[$i]->status }}</td>
                    <td>{{ $userTrips[$i]->posterprice}}</td>
                    @if($userTrips[$i]->status == "Ordered")
                        <td><input type="submit" class="btn btn-warning" value="Reject" formaction="RejectOrder" formmethod="post"/></td>
                        <td><input type="submit" class="btn btn-success" value="Start" formaction="StartOrder" formmethod="post"/></td>
                    @elseif($userTrips[$i]->status == "Started")
                        <td><input  type="submit" class="btn btn-success" value="End" formaction="EndOrder" formmethod="post"/></td>
                    @endif
                </tr>
            </form>
        @endfor
        </tbody>
    </table>
@endsection