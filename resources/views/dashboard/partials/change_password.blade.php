<form ng-submit="changePassword()" >
<ul class="list-group ">
	<li class="list-group-item active"> Change Your password</li>
	<li class="list-group-item">
	<label> Old Password</label>
	<input ng-minlength="8" type="password" class="form-control" ng-model="oldPassword"/>

	 </li>
	 <li class="list-group-item">
	<label> New Password</label>
	<input ng-minlength="8" type="password" class="form-control" ng-model="newPassword"/>
	 </li>
	 <li class="list-group-item">
	<label> Confirm Password</label>
	<input  ng-minlength="8" type="password" class="form-control" ng-model="confirmPassword"/>
	 </li>
	  <li class="list-group-item">
	<input type="submit" ng-disabled="( !oldPassword || !newPassword || !confirmPassword || ( newPassword != confirmPassword) ) "  value="Change password" class="btn btn-primary" />
	 </li>
</ul>
</form>
<div ng-if=" newPassword != confirmPassword" >
	<response-messages info="New Password and Confirmation password not matched" type="warning" ></response-messages>
</div>