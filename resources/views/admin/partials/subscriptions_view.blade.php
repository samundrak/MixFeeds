<div class="row">
<ul class="list-group-item">
	<li class="list-group-item">
		There are total <b>@{{ plans.length || 0}}</b> Subscription Plans
	</li>
	<li class="list-group-item">
		Most Used Subscription Plan is <b> @{{ stats.plan}} </b> <br/>
		Used total <b>@{{ stats.total }}</b> times
	</li>

	<li class="list-group-item">
	<table class="table table-striped">
	<tr>
		<th>Plan</th>
		<th>Cost</th>
		<th>Status</th>
		<th>Pages Allowed</th>
		<th>Plan ID</th>
		<th>Created At</th>
		<th>Action</th>
	</tr>
	<tr ng-repeat="plan in plans">
		<td>  @{{ plan.plan }} </td>
		<td> @{{ plan.amount }}$ </td>
		<td> @{{ plan.active === '1' ? 'Acitve' : 'Unactive'}}</td>
		<td> @{{ plan.pages }} </td>
		<td> @{{ plan.plan_id}} </td>
		<td>@{{plan.created_at | date:'medium'}}</td>
		<td>
		<select class="form-control" ng-model="plan.action" ng-init="plan.action =  action[0]"  ng-options="act.title for act in action"></select>
		</td>
		<td>
		<input type="button" ng-click="startAction(plan,$index)" class="btn btn-default" value="Submit"/>
		</td>
	</tr>
	</table>
	</li>
</ul>
</div>