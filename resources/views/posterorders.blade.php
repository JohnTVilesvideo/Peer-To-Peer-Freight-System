@extends("app")

@section("content")

<h2>Poster Orders</h2>
<p>Poster Orders table shows all the orders you have placed, you can cancel the orders
    that are not started</p>
<table class="table table-striped">
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
                <td><input type="hidden" name="trip" value="{{ $userTrips[$i]->tripid }}" /></td>
                <td>{{ $userTrips[$i]->start }}</td>
                <td>{{ $userTrips[$i]->end  }}</td>
                <td>{{ $userTrips[$i]->drivername  }}</td>
                <td>{{ $userTrips[$i]->posterprice }}</td>
                <td>{{ $userTrips[$i]->capacity  }}</td>
                <td>{{ $userTrips[$i]->offered }}</td>
                <td>{{ $userTrips[$i]->status }}</td>
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
@endsection