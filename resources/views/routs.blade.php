@extends("app")

@section("content")
    <h2>Routes:</h2>
    <p>Routes table shows all the routes in the system.
        Only Admin can modify the routes or add a route</p>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Start</th>
            <th>End</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @for($i = 0; $i < count($routs); $i++)
            <form action="ModifyRoute" method="post">
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td><input type="text" style="width:100px;" value="{{ $routs[$i]->start }}" name="start"/></td>
                    <td><input type="text" value="{{ $routs[$i]->end }}" name="end"/> </td>
                    <input type="hidden" name="routeid" value="{{ $rout[$i]->id }}" />
                    <input type="hidden" name="userid" value="{{ $userId }}" />
                    <td><input type="submit" class="btn btn-warning" value="Modify">
                    <input type="submit" class="btn btn-danger" value="Delete" formaction="DeleteRoute" formmethod="post"/> </td>
                </tr>
            </form>
        @endfor
        <form>
            <tr>
                <td>{{ count($routs)+1 }}</td>
                <td><input type="text" style="width:100px;" name="start"/> </td>
                <td><input type="text" style="width: 100px;" name="end" /></td>
                <input type="hidden" name="userid" value="{{ $userId }}" />
                <td><input type="submit" class="btn btn-success" value="Create" formaction="CreateRoute" formmethod="post"/> </td>
            </tr>
        </form>
        </tbody>
    </table>
@endsection