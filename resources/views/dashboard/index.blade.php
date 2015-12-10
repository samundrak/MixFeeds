@include('global.headers')
<body ng-app="static">

 <div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<nav class="navbar navbar-default" role="navigation">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						 <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
					</button> <a class="navbar-brand" ui-href="home">{{Auth::user()->firstname}}  {{Auth::user()->lastname}}</a>
				</div>

				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li >
							<a href="/dashboard/home">Home</a>
						</li>
						@if (Auth::user()->is_verified != 2 && Auth::user()->is_verified != 3)
						<li ui-sref-active="active">
							<a ui-sref="dashboard({page:'account'})">My Accounts</a>
						</li>
						@endif
						 <li ui-sref-active="active">
							<a ui-sref="dashboard({page:'profile'})">My Profile</a>
						</li>
						@if (Auth::user()->is_verified != 2 && Auth::user()->is_verified != 3)

						<li ui-sref-active="active">
							<a ui-sref="settings.changePassword">Settings</a>
						</li>
						</li><li ui-sref-active="active">
							<a ui-sref="widgets">Widgets</a>
						</li>
						@if(Auth::user()->is_admin === '1')
						 <li ui-sref-active="active">
							<a ui-sref="adminUsers">Manage Users</a>
						</li>
						<li ui-sref-active="active">
							<a ui-sref="adminSubscription">Manage Subscription</a>
						</li>
						{{-- <li ui-sref-active="active"> --}}
							{{-- <a ui-sref="adminWidgets">Manage Widgets</a> --}}
						{{-- </li> --}}
						@endif
						@endif
						<li href-active="active">

							<a href="/logout">Logout</a>
						</li>
					</ul>
					{{-- <form class="navbar-form navbar-left" role="search">
						<div class="form-group">
							<input type="text" class="form-control" />
						</div>
						<button type="submit" class="btn btn-default">
							Submit
						</button>
					</form> --}}

				</div>

			</nav>
			<div class="jumbotron">
			<response-messages ng-if="{{Auth::user()->is_verified }} === 0" info="You are not verified user please verify your email" type="warning" ></response-messages>
			<response-messages ng-if="{{Auth::user()->is_verified }} === 2" info="You are Blocked from access of all services" type="danger" ></response-messages>
			<response-messages ng-if="{{Auth::user()->is_verified }} === 3" info="You are Deleted" type="danger" ></response-messages>
			{{-- <response-messages ng-if="{{Auth::user()->is_admin }} === 1" info="You are admin and can manage things more" type="info" ></response-messages> --}}
			<div class="row">
			<response-messages  popup="true" ng-if="notification" messages="notification" ></response-messages>
			<ui-view>
					 <span  class="glyphicon glyphicon-refresh spinning"></span>

			</ui-view>
			 @yield('content')

	</div>
			</div>
		</div>
	</div>

</div>
<script>
	$token = '{{ csrf_token() }}';
</script>
@if(Auth::user()->is_admin === '1')
	<script type="text/javascript" src="{{ URL::asset('/public/javascript/src/admin_app.js')}}"></script>
@endif
</body>
</html>