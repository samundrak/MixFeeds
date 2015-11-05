@include('global.headers')
<body ng-app="static">
 <div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<nav class="navbar navbar-default" role="navigation">
				<div class="navbar-header">

					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						 <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
					</button> <a class="navbar-brand" ui-href="home">Samundra kc</a>
				</div>

				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li ui-sref-active="active">
							<a ui-sref="home">Home</a>
						</li>
						<li ui-sref-active="active">
							<a ui-sref="contact">Contact</a>
						</li>
						 <li ui-sref-active="active">
							<a ui-sref="content">Content</a>
						</li><li ui-sref-active="active">
							<a ui-sref="about">About</a>
						</li>
						@if (Auth::check())
						<li ui-sref-active="active">
							<a href="/dashboard/home">Dashboard</a>
						</li>
						<li ui-sref-active="active">
							<a href="/logout">Logout</a>
						</li>
						@else
						</li><li ui-sref-active="active">
							<a ui-sref="register">Register</a>
						</li>
						<li ui-sref-active="active">
							<a ui-sref="login">Login</a>
						</li>
						@endif
					</ul>
					<form class="navbar-form navbar-left" role="search">
						<div class="form-group">
							<input type="text" class="form-control" />
						</div>
						<button type="submit" class="btn btn-default">
							Submit
						</button>
					</form>

				</div>

			</nav>
			<div class="jumbotron">
			<response-messages ng-if="notification" messages="notification" ></response-messages>

			<ui-view></ui-view>

			</div>
		</div>
	</div>
	<div class="row">
	 @yield('content')
	</div>
</div>
</body>
</html>