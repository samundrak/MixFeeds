<div class="row">
<form ng-submit="createWidget()">
<ul class="list-group-item">
	<li class="list-group-item active">
		Create Subscriptions
	</li>
	<li class="list-group-item">
	Subscription Name
		<input required type="text" ng-model="create.name" class="form-control"/>
	</li>
	<li class="list-group-item">
	Subscription Price
	<input required type="number" ng-model="create.price" class="form-control"/>
	</li>
	<li class="list-group-item">
	Total Allowed Widgets
	<input required type="number" ng-model="create.widgets" class="form-control"/>
	</li>
	<li class="list-group-item">
	 Total Allowed Pages
	 <input required type="number" ng-model="create.pages" class="form-control"/>
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
		<div ng-repeat="point in create.points track by $index">
			<input placeholder="Enter key points of this plan... @{{$index + 1}} " type="text" class="form-control" ng-model="create.points[$index]" /> <div class="btn btn-danger" ng-click="removePoints($index)"> X </div>
		</div>
		<br/>
		<div class="btn btn-primary"  ng-click="addPoints()"> + Add Points</div>
	</li>
	<li class="list-group-item">
	<input required type="submit" class="btn btn-primary" value="submit"/>
	</li>
</ul>
</form>
</div>