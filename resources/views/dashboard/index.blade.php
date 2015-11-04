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
							<a href="home">Home</a>
						</li>
						<li ui-sref-active="active">
							<a ui-sref="dashboard({page:'account'})">My Accounts</a>
						</li>
						 <li ui-sref-active="active">
							<a ui-sref="dashboard({page:'profile'})">My Profile</a>
						</li><li ui-sref-active="active">
							<a ui-sref="dashboard({page:'settings'})">Settings</a>
						</li>
						</li><li ui-sref-active="active">
							<a ui-sref="widgets">Widgets</a>
						</li>
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
			<div class="row">
			<response-messages ng-if="notification" messages="notification" ></response-messages>
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
</body>
</html>