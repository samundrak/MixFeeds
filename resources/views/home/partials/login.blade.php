@if (Auth::check())
<script type="text/javascript">
    window.location = "/dashboard/home#/account";
</script>
@endif
<div class="row">
<div class="col-md-3"></div>
<div class="col-md-6">
<div class="panel panel-primary">
<div class="panel-heading padding-10">
    <h4 class="panel-title-c1" id="codeViewLabel">Login</h4>
</div>
<div class="panel-body padding-20">
<form method="POST" ng-submit="login()" >
    {!! csrf_field() !!}

    <div class="margin-top-10">
        Email
        <input class="form-control" type="email" ng-model="email" >
    </div>

    <div class="margin-top-10">
        Password
        <input ng-minlength="8" class="form-control" type="password" ng-model="password" id="password">
    </div>

    <div class="margin-top-10">
        {{-- <input type="checkbox" name="remember"> Remember Me --}}
    </div>

    <div class="margin-top-10">
        <input class="btn btn-primary" value="Login" type="submit" ng-disabled="( !email || !password )"/>
    </div>
</form>
<div class="margin-top-10">
    <a ui-sref="forget_password">Forget Password</a>
</div>
<div class="margin-top-20">
If you haven't Registered yet. Please <a style=" text-decoration:underline" href="#/register">Register</a> Now.
</div>
</div>
</div>
</div>
<div class="col-md-3"></div>
</div>
