
<ul class="list-group">
	<li class="list-group-item"  >
		Your total Balance is: <b>  <span ng-model="amount" ng-init="amount = '{{ Auth::user()->balance }}'">@{{amount}}</span>$</b>
	</li>
	<br/>
	<li class="list-group-item active">
		Subscription Packages
	</li>
	<li class="list-group-item">
		<div class="row">
			<div class="col-md-12" ng-if="plans.message">@{{ plans.message}}</div>
			<div ng-repeat="plan in plans.data.plans" class="col-md-4">@{{ plan.plan }} (@{{ plan.amount}}$/month)
				<br/>
				<a ng-click="subscribe(plan.id)" href="javascript:void(0)">Subscribe</a>
			</div>
		</div>
	</li>
	<br/>
	<li class="list-group-item active"> Subscription Details</li>
	<li class="list-group-item">
		<div ng-if="!subscription.success"> @{{ subscription.message}} </div>
		<div ng-if="subscription.success">
		<table class="table table-condensed">
			<tr>
				<th>SubscriptionID</th>
				<th>Start Date</th>
				<th>End Date</th>
				<th>Plan</th>
				<th>Amount</th>
			</tr>
			<tr ng-repeat="details in subscription.data" >
				<td> @{{ details.id }}</td>
				<td>@{{ details.start }}</td>
				<td>@{{ details.end }}</td>
				<td>@{{ details.plan }}</td>
				<td>@{{ details.amount }}$</td>
			</tr>
		</table>

		<pagination  ng-if="subscription" last="subscription.data[subscription.data.length - (subscription.data.length)].id" span="5" total="subscription.total"></pagination></div>
	</li>
</ul>