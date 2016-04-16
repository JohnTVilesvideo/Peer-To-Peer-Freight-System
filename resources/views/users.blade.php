@extends("app")

@section("content")
    <h2>User:</h2>
    <p>Users table shows all the users in the system, including Admins, Drivers, Posters.
        Only Admin can modify the users or add a user directly</p>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Type</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @for($i = 0; $i < count($users); $i++)
            <form action="ModifyUser" method="post">
                <tr>
                    <td>{{ $i + 1 }}</td>
                    {{ csrf_field() }}
                    <td><input type="text" style="width:100px;" value="{{ $users[$i]->name }}" name="name"/></td>
                    <td><input type="email" value="{{ $users[$i]->email }}" name="email"/> </td>
                    <td><input type="text"  name="password" /></td>
                    <td>
                        @if($users[$i]->type == 0)
                            Admin
                        @elseif($users[$i]->type == 1)
                            Driver
                        @elseif($users[$i]->type == 2)
                            Poster
                        @endif
                    <input type="hidden" name="userid" value="{{ $users[$i]->id }}" />
                    <input type="hidden" name="loginuserid" value="{{ $userId }}"/>
                    <td><input type="submit" class="btn btn-warning" value="Modify">
                    <input type="submit" class="btn btn-danger" value="Delete" formaction="DeleteUser" formmethod="post"/> </td>
                </tr>
            </form>
        @endfor
        <form>
        <tr>
            <td>{{ count($users)+1 }}</td>
            {{ csrf_field() }}
            <td><input type="text" style="width:100px;" name="name"/> </td>
            <td><input type="email" name="email" /></td>
            <td><input type="password" name="password" /></td>
            <td><select name="type">
                    <option value="0">Admin</option>
                    <option value="1">Driver</option>
                    <option value="2">Poster</option>
                </select></td>
            <input type="hidden" name="loginuserid" value="{{ $userId }}"/>
            <td><input type="submit" class="btn btn-success" value="Create" formaction="CreateUser" formmethod="post"/> </td>
        </tr>
        </form>
        </tbody>
    </table>
@endsection