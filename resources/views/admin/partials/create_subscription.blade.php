<div class="row">
<form ng-submit="createWidget()">
<div class="panel panel-primary">
<div class="panel-heading padding-10">
	<h3 class="panel-title-c1">Create Subscriptions</h3>
</div>
<div class="panel-body">
<ul class="">
	
	<li class="list-group-item">
	Subscription Name
		<input required type="text" ng-model="create.name" class="form-control"/>
	</li>
	<li class="list-group-item">
	Subscription Price
	<input required type="text" ng-model="create.price" class="form-control"/>
	</li>
	<li class="list-group-item">
	Total Allowed Widgets
	<input required type="text" ng-model="create.widgets" class="form-control"/>
	</li>
	<li class="list-group-item">
	 Total Allowed Pages
	 <input required type="text" ng-model="create.pages" class="form-control"/>
	</li>

	<li class="list-group-item">
	 Allow Adjust Size options<br/>
	 <input required type="radio" ng-model="create.settings.size" name="size" value="true" /> Allow
	 <input required type="radio" ng-model="create.settings.size" name="size" value="false" /> Deny
	</li>

	<li class="list-group-item">
	Allow Adjust Display options
<br/>
	 <input required type="radio" ng-model="create.settings.display" name="display" value="true" /> Allow
	 <input required type="radio" ng-model="create.settings.display" name="display" value="false" /> Deny
	</li>

	<li class="list-group-item">
	Allow friends face options
	<br/>
	 <input required type="radio" ng-model="create.settings.friends_face" name="face" value="true" /> Allow
	 <input required type="radio" ng-model="create.settings.friends_face" name="face" value="false" /> Deny

	</li>

	<li class="list-group-item">
	Allow cover photo options
	<br/>
	 <input required type="radio" ng-model="create.settings.hide_cover_photo" name="photo" value="true" /> Allow
	 <input required type="radio" ng-model="create.settings.hide_cover_photo" name="photo" value="false" /> Deny

	</li>

	<li class="list-group-item">
	Allow small header options
	<br/>
	 <input required type="radio" ng-model="create.settings.small_header" name="header" value="true" /> Allow
	 <input required type="radio" ng-model="create.settings.small_header" name="header" value="false" /> Deny

	</li>

	<li class="list-group-item">
	Allow random post options
	<br/>
	 <input required type="radio" ng-model="create.settings.random" name="random" value="true" /> Allow
	 <input required type="radio" ng-model="create.settings.random" name="random" value="false" /> Deny

	</li>

	<li class="list-group-item">
	Allow latest post options
	<br/>
	 <input required type="radio" ng-model="create.settings.latest" name="latest" value="true" /> Allow
	 <input required type="radio" ng-model="create.settings.latest" name="latest" value="false" /> Deny
	</li>
	<li class="list-group-item">
	Create Points
		<div class="row">
			<div ng-repeat="point in create.points track by $index">
				<div class="clearfix margin-top-10">
					<div class="col-lg-8 col-md-8">
						<input placeholder="Enter key points of this plan... @{{$index + 1}} " type="text" class="form-control" ng-model="create.points[$index]" /> 
					</div>
					<div class="col-lg-4 col-md-4">
						<div class="btn btn-danger" ng-click="removePoints($index)"> X </div>
					</div>
				</div>
			</div>
			
			<div class="col-lg-12">
				<div class="clearfix margin-top-20">
					<div class="btn btn-primary"  ng-click="addPoints()"> + Add Points</div>
				</div>
			</div>
		</div>
	</li>
	
</ul>
</div>
<div class="panel-footer padding-10 text-right ">
	<input required type="submit" class="btn btn-primary" value="SUBMIT"/>
</div>
</div>
</form>
</div>