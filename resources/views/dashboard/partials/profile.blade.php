 <div ng-messages="up.$error">
        <div ng-message="maxlength"><response-messages  messages="['This feild is too short']"></response-messages></div>
        <div ng-message="minlength"><response-messages  messages="['This feild is too long']"></response-messages></div>
         <div ng-message="required"><response-messages  messages="['This feild is required']"></response-messages></div>
    </div>
<div ng-if="dashboard.profile.alert.message">
	<response-messages messages="dashboard.profile.alert.message" ></response-messages>
</div>
<form name="up" ng-submit="updateProfile()" method="post">
	<ul class="list-group">
		<li class="list-group-item active">Welcome @{{dashboard.profile.firstname +' '+ dashboard.profile.lastname  }}</li>
		<li class="list-group-item">Firstname
			<input
			name="firstname" ng-minlength="3" ng-maxlength="100" ng-required="true"
			type="text" class="form-control" ng-model="dashboard.profile.firstname"/>
		</li>
		<li class="list-group-item">Lastname
			<input name="lastname"
			ng-minlength="3" ng-maxlength="100" ng-required="true"
			type="text" class="form-control" ng-model="dashboard.profile.lastname"/>
		</li>
		<li class="list-group-item">Email
			<input name="email"
			ng-minlength="3" ng-maxlength="100" ng-required="true"
			type="email" class="form-control" ng-model="dashboard.profile.email"/>
			{!! csrf_field() !!}
		</li>
		<li class="list-group-item">
			<input class="btn btn-primary"  type="submit" value="Update"/>
		</li>
	</form>
</ul>
