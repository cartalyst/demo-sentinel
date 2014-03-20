<!DOCTYPE html>
<html>
	<head>
		<title>
			@section('title')
			Sentry 3 Demo
			@show
		</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap -->
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->
		<style type="text/css">
		body {
			padding-top: 70px;
		}
		</style>
	</head>
	<body>

		<div class="container">

			<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">

				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="{{ URL::to('/') }}">Sentry 3 Demo</a>
					</div>
					<div class="collapse navbar-collapse">
						<ul class="nav navbar-nav">
							<li{{ Request::is('/') ? ' class="active"' : null }}><a href="{{ URL::to('/') }}">Home</a></li>
							@if ( ! Sentry::check())
							<li{{ Request::is('login') ? ' class="active"' : null }}><a href="{{ URL::to('login') }}">Login</a></li>
							<li{{ Request::is('register') ? ' class="active"' : null }}><a href="{{ URL::to('register') }}">Register</a></li>
							@else
							<li{{ Request::is('users*') ? ' class="active"' : null }}><a href="{{ URL::to('users') }}">Users</a></li>
							<li{{ Request::is('groups*') ? ' class="active"' : null }}><a href="{{ URL::to('groups') }}">Groups</a></li>
							@endif
						</ul>
						@if ($user = Sentry::check())
						<ul class="nav navbar-nav pull-right">
							<li{{ Request::is('account') ? ' class="active"' : null }}><a href="{{ URL::to('account') }}">Account
							@if ( ! $user->isActivated())
								<span class="label label-danger">Inactive</span>
							@endif
							</a></li>
							<li><a href="{{ URL::to('logout') }}">Logout</a></li>
						</ul>
						@endif
					</div>
				</div>

			</div>

			@if ($errors->any())
				<div class="alert alert-danger alert-block">
					<button type="button" class="close" data-dismiss="alert"><i class="fa fa-minus-square"></i></button>
					<strong>Error</strong>
					@if ($message = $errors->first(0, ':message'))
						{{ $message }}
					@else
						Please check the form below for errors
					@endif
				</div>
			@endif

			@if ($message = Session::get('success'))
				<div class="alert alert-success alert-block">
					<button type="button" class="close" data-dismiss="alert"><i class="fa fa-minus-square"></i></button>
					<strong>Success</strong> {{ $message }}
				</div>
			@endif


			@yield('body')

		</div>

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://code.jquery.com/jquery.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
	</body>
</html>
