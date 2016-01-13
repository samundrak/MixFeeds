{{-- action="/auth/register" --}}
<div class="row">
<div class="col-md-3"></div>
<div class="col-md-6">
<div class="panel panel-primary">
<div class="panel-heading padding-10">
    <h4 class="panel-title-c1" id="codeViewLabel">Register</h4>
</div>
<div class="panel-body padding-20">
<form ng-submit="register()" >
    {!! csrf_field() !!}

    <div class="margin-top-10">
        Firstname
        <input class="form-control" type="text" ng-model="firstname">
    </div>
    <div class="margin-top-10">
        Lastname
        <input class="form-control" type="text" ng-model="lastname"  >
    </div>

    <div class="margin-top-10">
        Email
        <input class="form-control" type="email" ng-model="email"  >
    </div>

    <div class="margin-top-10">
        Password
        <input class="form-control" type="password" ng-model="password">
    </div>

    <div class="margin-top-10">
        Confirm Password
        <input class="form-control" type="password" ng-model="password_confirmation">
    </div>
    <div class="margin-top-20">
        <button ng-disabled="( !firstname || !lastname || !email || !password || !password_confirmation || (password != password_confirmation) )" type="submit" class="btn btn-primary">Register</button>
    </div>
</form>
<br/>
<div ng-if=" password != password_confirmation" >
    <response-messages info="New Password and Confirmation password did not matched" type="warning" ></response-messages>
</div>
<div class="margin-top-20">
Back to <a style=" text-decoration:underline" href="#/login">Login</a>
</div>
</div>
</div>
</div>
<div class="col-md-3"></div>
</div>

