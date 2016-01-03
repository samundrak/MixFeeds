{{-- action="/auth/register" --}}
<form ng-submit="register()" >
    {!! csrf_field() !!}

    <div>
        Firstname
        <input class="form-control" type="text" ng-model="firstname">
    </div>
 <div>
        Lastname
        <input class="form-control" type="text" ng-model="lastname"  >
    </div>

    <div>
        Email
        <input class="form-control" type="email" ng-model="email"  >
    </div>

    <div>
        Password
        <input class="form-control" type="password" ng-model="password">
    </div>

    <div>
        Confirm Password
        <input class="form-control" type="password" ng-model="password_confirmation">
    </div>
<br/>
    <div>
        <button ng-disabled="( !firstname || !lastname || !email || !password || !password_confirmation || (password != password_confirmation) )"type="submit" class="btn btn-primary">Register</button>
    </div>
</form>
<br/>
<div ng-if=" password != password_confirmation" >
    <response-messages info="New Password and Confirmation password not matched" type="warning" ></response-messages>
</div>