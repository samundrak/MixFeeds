<form method="POST" ng-submit="login()" >
    {!! csrf_field() !!}

    <div>
        Email
        <input class="form-control" type="email" ng-model="email" >
    </div>

    <div>
        Password
        <input ng-minlength="8" class="form-control" type="password" ng-model="password" id="password">
    </div>

    <div>
    <br/>
        {{-- <input type="checkbox" name="remember"> Remember Me --}}
    </div>

    <div>
        <input class="btn btn-primary" type="submit" ng-disabled="( !email || !password )"/>
    </div>
</form>
<br/>
<div >
    <a ui-sref="forget_password">Forget Password</a>
</div>