<form ng-submit="changeEmail()" name="change_mail" method="post">
<ul class="list-group ">
	<li class="list-group-item active"> Change Your Email</li>
	<li class="list-group-item">
	<label> Old Email</label>
	<input type="email" class="form-control" ng-init="oldEmail = '{{Auth::user()->email}}' " ng-model="oldEmail"/>
	 </li>
	 <li class="list-group-item">
	<label> New Email</label>
	<input type="email" class="form-control" ng-model="newEmail"/>
	 </li>
	 <li class="list-group-item">
	<label> Enter Password</label>
	<input type="password" class="form-control" ng-model="password"/>
	 </li>
	  <li class="list-group-item">
	<input type="submit"  ng-disabled="( !oldEmail || !newEmail || !password )" value="Change Email" class="btn btn-primary" />
	 </li>
</ul>
</form>
