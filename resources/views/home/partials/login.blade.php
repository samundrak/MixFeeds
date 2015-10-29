<!-- resources/views/auth/login.blade.php -->
<p>
    {{ $errors->first('email') }}
    {{ $errors->first('password') }}
</p>
<form method="POST" action="/auth/login">
    {!! csrf_field() !!}

    <div>
        Email
        <input class="form-control" type="email" name="email" value="{{ old('email') }}">
    </div>

    <div>
        Password
        <input class="form-control" type="password" name="password" id="password">
    </div>

    <div>
        <input type="checkbox" name="remember"> Remember Me
    </div>

    <div>
        <button class="btn btn-primary" type="submit">Login</button>
    </div>
</form>

@unless (Auth::check())
    You are not signed in.
@endunless
 