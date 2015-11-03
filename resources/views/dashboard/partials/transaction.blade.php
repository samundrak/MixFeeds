<ul class="list-groupt">
	<li class="list-group-item"  >
		Your total Balance is: <b>  <span ng-model="amount" ng-init="amount = '{{ Auth::user()->balance }}'">@{{amount}}</span>$</b>
	</li><br/>
	<li class="list-group-item active"> Your transaction details</li>
	<li class="list-group-item"></li>
</ul>