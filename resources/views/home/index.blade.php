<!DOCTYPE html>
<html>
<head>
	<title>Static Dummy Site on Laravel</title>
	<script type="text/javascript" src="javascript/lib/bower_components/jquery/dist/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="javascript/lib/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="styles/styles.css">
	<link rel="stylesheet" type="text/css" href="styles/loading-bar.css">


	<script type="text/javascript" src="javascript/lib/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="javascript/lib/bower_components/angular/angular.min.js"></script>
	<script type="text/javascript" src="javascript/lib/angular-animate.js"></script>
	<script type="text/javascript" src="javascript/lib/angular-loading-bar.js"></script>
	<script type="text/javascript" src="javascript/lib/angular-ui-router.min.js"></script>
	<script type="text/javascript" src="javascript/src/app.js"></script>
</head>
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
			<ui-view></ui-view>	

			</div>
		</div>
	</div>
	<div class="row">
		<!-- <div class="col-md-4">
			<h2>
				Heading
			</h2>
			<p>
				Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.
			</p>
			<p>
				<a class="btn" href="#">View details »</a>
			</p>
		</div>
		<div class="col-md-4">
			<h2>
				Heading
			</h2>
			<p>
				Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.
			</p>
			<p>
				<a class="btn" href="#">View details »</a>
			</p>
		</div>
		<div class="col-md-4">
			<h2>
				Heading
			</h2>
			<p>
				Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.
			</p>
			<p>
				<a class="btn" href="#">View details »</a>
			</p>
		</div> -->
	</div>
</div>
</body>
</html>