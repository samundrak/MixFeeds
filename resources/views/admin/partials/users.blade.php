<div class="col-md-12">
<ul class="list-group">
	<li class="list-group-item">
		Currently @{{ users.length }} user Registered
	</li>
	<li class="list-group-item">
		Currently @{{ totalAdmin(users) }} user are Admin
	</li>
	<li class="list-group-item">
	<table class="table table-striped">
	<tr>
		<th>Firstname</th>
		<th>Lastname</th>
		<th>Email</th>
		<th>Balance</th>
		<th>Admin</th>
		<th>Status</th>
		<th>Member since</th>
		<th>Action</th>
		<th></th>
	</tr>
	<tr ng-repeat="user in users">
		<td> @{{ user.firstname}} </td>
		<td> @{{user.lastname}} </td>
		<td> @{{ user.email }} </td>
		<td> @{{ user.balance }}$ </td>
		<td> @{{ user.is_admin === '1' ?  'Admin' : 'Not Admin'}} </td>
		<td> @{{ getCodes(user.is_verified) }}</td>
		<td> @{{user.created_at | date:'medium'}} </td>
		<td>
		<select class="form-control" ng-model="user.action" ng-init="user.action =  actionLists[0]"  ng-options="act.title for act in actionLists"></select>
		</td>
		<td>
		<input type="button" ng-click="startAction(user,$index)" class="btn btn-default" value="Submit"/>
		</td>
	</tr>
	</table>
	</li>
</ul>
</div>