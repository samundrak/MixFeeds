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
			<div class="col-md-4">Small (10$/month)
				<br/>
				<a href="javascript:void(0)">Subscribe</a>
			</div>
			<div class="col-md-4">Medium (20$/month)
				<br/>
				<a href="javascript:void(0)">Subscribe</a>
			</div>
			<div class="col-md-4">Super (30$/month)
				<br/>
				<a href="javascript:void(0)">Subscribe</a>
			</div>
		</div>
	</li>

	<br/>
	<li class="list-group-item active"> Subscription Details</li>
	<li class="list-group-item"></li>
</ul>