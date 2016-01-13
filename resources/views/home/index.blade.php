@include('global.headers')
<body ng-app="static">
 <div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
		@if (Auth::check())
			<nav class="navbar navbar-default" role="navigation">
				<div class="navbar-header">

					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						 <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
					</button> <a class="navbar-brand" ui-href="home">Multiembed</a>
				</div>

				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						
						
						<li ui-sref-active="active">
							<a href="/dashboard/home">Dashboard</a>
						</li>
						<li ui-sref-active="active">
							<a href="/logout">Logout</a>
						</li>
						
					</ul>
				</div>

			</nav>
			@endif
			<div class="jumbotron">
			<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
			<response-messages ng-if="notification" messages="notification" ></response-messages>
			</div>
			<div class="col-md-3"></div>
			</div>
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