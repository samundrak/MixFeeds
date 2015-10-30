	<response-messages  ng-if="response_message" messages="response_message" ></response-messages>
<div class="col-md-3">
	<ul class="list-group">
		<li   class="list-group-item">
			<a ui-sref="widgets">Widgets</a>
		</li>
		<li class="list-group-item"  >
			<a ui-sref="widgets.create">Create Widgets</a>
		</li>
	</ul>
</div>
<div class="col-md-9">
	<ui-view>
	<ul class="list-group">
		<li class="list-group-item active">
		Account Details</li>
		<li ng-repeat="widget in widgets.data" class="list-group-item">
			<label>Name: </label> @{{ widget.widget_name}}
			<br/>
			<label>Domain: </label> @{{ widget.domain}}
			<br/>
			<label>Page: </label> @{{ widget.page_name}}
			<br/>
			<div class="btn-group" role="group" aria-label="...">
				<button type="button" class="btn btn-default">Edit</button>
				<button type="button" class="btn btn-default">Preview</button>
				<button type="button" class="btn btn-default">Get Code</button>
				<button type="button" ng-click="deleteWidget($index)" class="btn btn-default">Delete</button>
			</div>
		</li>
		<li class="list-group-item" ng-if="!widgets.data.length" >
			@{{widgets.message || 'Please go to next page for more widgets'}}
		</li>
		<li  ng-if="widgets.data" class="list-group-item">
		<pagination  last="widgets.data[widgets.data.length- (widgets.data.length)].id" span="5" total="widgets.total"></pagination>
	</li>
</ul>
</ui-view>
</div>