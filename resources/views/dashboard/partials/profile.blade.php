<div ng-if="dashboard.profile.alert.message">
<response-messages messages="dashboard.profile.alert.message" ></response-messages>
</div>
<form ng-submit="updateProfile()" method="post">
<ul class="list-group">
	<li class="list-group-item active">Welcome @{{dashboard.profile.firstname +' '+ dashboard.profile.lastname  }}</li>
	<li class="list-group-item">Firstname
  		<input type="text" class="form-control" ng-model="dashboard.profile.firstname"/>
	</li>
	<li class="list-group-item">Lastname
  		<input type="text" class="form-control" ng-model="dashboard.profile.lastname"/>

	</li>
	<li class="list-group-item">Email
  		<input type="email" class="form-control" ng-model="dashboard.profile.email"/>
    	{!! csrf_field() !!}

	</li>
	<li class="list-group-item">
  		<input class="btn btn-primary"  type="submit" value="Update"/>
	</li>
	</form>
</ul>