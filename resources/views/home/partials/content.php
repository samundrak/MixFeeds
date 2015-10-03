<div class="row">
<form ng-submit="addContent()">
<div class="col-md-10">
	<input type="text" ng-model="content" placeholder="Type text to add content" class="form-control"/>
	</div>
<div class="col-md-2">

	<input type="submit" value="Add" class="btn btn-primary"/>
</div>
</form>
</div>
<br/>
<ul class="list-group">
	<li class="list-group-item" ng-repeat="post in contents track by $index">{{ post }}</li>
</ul>