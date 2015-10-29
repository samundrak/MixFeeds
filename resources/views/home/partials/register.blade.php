<!-- resources/views/auth/register.blade.php -->

@if ($errors->has())
@foreach($errors->all() as $error)
{{$error}}
@endforeach
@endif
<form method="POST" action="/auth/register">
    {!! csrf_field() !!}

    <div>
        Firstname
        <input class="form-control" type="text" name="firstname" value="{{ old('firstname') }}">
    </div>
 <div>
        Lastname
        <input class="form-control" type="text" name="lastname" value="{{ old('lastname') }}">
    </div>

    <div>
        Email
        <input class="form-control" type="email" name="email" value="{{ old('email') }}">
    </div>

    <div>
        Password
        <input class="form-control" type="password" name="password">
    </div>

    <div>
        Confirm Password
        <input class="form-control" type="password" name="password_confirmation">
    </div>

    <div>
        <button type="submit" class="btn btn-primary">Register</button>
    </div>
</form>