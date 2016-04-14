<!-- resources/views/auth/register.blade.php -->

<form method="POST" action="/auth/register">
    {!! csrf_field() !!}

    <div>
        User Type
        <input type="radio" id="driver" name="usertype" value="1" content="Driver" checked="checked"/><label for="driver" >Driver</label>
        <input type="radio" id="poster" name="usertype" value="2" content="Poster"/><label for="poster">Poster</label>
    </div>
    <div>
        Name
        <input type="text" name="name" value="{{ old('name') }}">
    </div>

    <div>
        Email
        <input type="email" name="email" value="{{ old('email') }}">
    </div>

    <div>
        Password
        <input type="password" name="password">
    </div>

    <div>
        Confirm Password
        <input type="password" name="password_confirmation">
    </div>

    <div>
        <button type="submit">Register</button>
    </div>
</form>