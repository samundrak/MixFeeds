<ul class="list-groupt">
	<li class="list-group-item"  >
		Your total Balance is: <b>  <span ng-model="amount" ng-init="amount = '{{ Auth::user()->balance }}'">@{{amount}}</span>$</b>
	</li><br/>
	<li class="list-group-item active"> Your transaction details</li>
	<li class="list-group-item" ng-if="!transaction.length"> No transaction details found</li>
			<li class="list-group-item">
	<table class="table table-striped">
	<tr>
		<th>S.N</th>
		<th>Amount</th>
		<th>Transaction on</th>
	</tr>
	<tr ng-repeat="x in transaction">
		<td>  @{{ $index +1 }} </td>
		<td> @{{ x.amount }}$ </td>
		<td>@{{ x.created_at | date:'medium'}}</td>
	</tr>
	</table>

	</li>
</ul>