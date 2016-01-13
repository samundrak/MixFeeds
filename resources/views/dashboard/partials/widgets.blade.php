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
		<div class="row">
		<div class="col-md-10">Widgets Details</div>
		<div class="col-md-2 text-right"  >
		<button class="btn btn-success" ng-click="loadWidgets()" >Refresh</button>
		</div>
</div>
		</li>
		<li ng-repeat="widget in widgets.data" class="list-group-item">
			<label>Name: </label> @{{ widget.widget_name}}
			<br/>
			<label>Domain: </label> @{{ widget.domain}}
			<br/>
			<label>Page: </label>
			<span ng-bind-html="widget.pages | arr2str:'link'" style="display:block"></span>
			<br/>
			<div class="btn-group margin-top-10" role="group" aria-label="...">
				<button ui-sref="widgets.edit({id:widget.id})" type="button" class="btn btn-default">Edit</button>
				<button type="button" ng-click="getCode(widget.id,true)" class="btn btn-default">Preview</button>
				<button type="button" ng-click="getCode(widget.id)" class="btn btn-default">Get Code</button>
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
<div style="color:black;" class="modal fade" id="codeView" tabindex="-1" role="dialog" aria-labelledby="codeViewLabel">
<div class="modal-dialog" role="document">
	<div class="panel panel-default">
		<div class="panel-heading padding-10">
			<div ng-if="!preview">
				<h4 class="panel-title-c1" id="codeViewLabel">Widget Code</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div ng-if="preview">
				<h4 class="panel-title-c1" id="codeViewLabel">Widget Preview</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>	
		</div>
		<div class="panel-body padding-10">	
			<div ng-if="!preview">
				<textarea ng-model="code" width="auto" rows="6" class="form-control" style="color:#999"></textarea>
				<label style="color:#607D8B; margin-top:15px"> Copy paste the above code into your website, where you want to display the widget</label>
			</div>
			<div ng-if="preview">
				<display-widget id="me" code="code"></display-widget>
			</div>
		</div>
		<div class="panel-footer text-right">
			<div ng-if="!preview">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>	
		</div>
	</div>
</div>