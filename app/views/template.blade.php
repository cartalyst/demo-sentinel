<!DOCTYPE html>
<html>
<head>
	<title>Sentinel</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="{{ URL::to('assets/css/bootstrap.min.css') }}" rel="stylesheet" media="screen">
	<link href="{{ URL::to('assets/css/font-awesome.min.css') }}" rel="stylesheet" media="screen">
	<link href="{{ URL::to('assets/css/demo.css') }}" rel="stylesheet" media="screen">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->

  </head>
  <body>

  	<div class="flux clearfix">
  		<div class="flux--1"></div>
  		<div class="flux--2"></div>
  		<div class="flux--3"></div>
  		<div class="flux--4"></div>
  		<div class="flux--5"></div>
  	</div>

  	<div class="container">

  		<nav class="navbar xnavbar-fixed-top navbar-inverse" role="navigation">

  			<div class="navbar-header">
  				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
  					<span class="sr-only">Toggle navigation</span>
  					<span class="icon-bar"></span>
  					<span class="icon-bar"></span>
  					<span class="icon-bar"></span>
  				</button>
  				<a class="navbar-brand" href="{{ URL::to('/') }}">Sentinel</a>
  			</div>

  			<div class="collapse navbar-collapse navbar-ex1-collapse">

  				<ul class="nav navbar-nav">
  					<li{{ Request::is('/') ? ' class="active"' : null }}><a href="{{ URL::to('/') }}">Home</a></li>
  					@if ( ! Sentinel::check())
  					<li{{ Request::is('login') ? ' class="active"' : null }}><a href="{{ URL::to('login') }}">Login</a></li>
  					<li{{ Request::is('register') ? ' class="active"' : null }}><a href="{{ URL::to('register') }}">Register</a></li>
  					@elseif (Sentinel::hasAccess('admin'))
  					<li{{ Request::is('users*') ? ' class="active"' : null }}><a href="{{ URL::to('users') }}">Users</a></li>
  					<li{{ Request::is('groups*') ? ' class="active"' : null }}><a href="{{ URL::to('groups') }}">Groups</a></li>
  					@endif
  				</ul>
  				@if ($user = Sentinel::check())
  				<ul class="nav navbar-nav pull-right">
  					<li{{ Request::is('account') ? ' class="active"' : null }}><a href="{{ URL::to('account') }}">Account
  					@if ( ! Activation::completed($user))
  					<span class="label label-danger">Inactive</span>
  					@endif
  				</a></li>
  				<li><a href="{{ URL::to('logout') }}">Logout</a></li>
  				</ul>
  				@endif

  				<ul class="nav navbar-nav navbar-right">
	  				<li><a href="https://cartalyst.com/manual/sentinel">Manual</a></li>
	  			</ul>

  		</div>
  	</nav>

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

  <script src="{{ URL::to('/assets/js/jquery.min.js') }}"></script>
  <script src="{{ URL::to('/assets/js/bootstrap.min.js') }}"></script>

  <script type="text/javascript">
  	$('.tip').tooltip();
  	//$('#modal').modal();
  </script>

  @yield('scripts')

  <script type="text/javascript">

  	var _gaq = _gaq || [];
  	_gaq.push(['_setAccount', 'UA-26550564-1']);
  	_gaq.push(['_setDomainName', 'cartalyst.com']);
  	_gaq.push(['_trackPageview']);

  	(function() {
  		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
  		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
  		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  	})();
  </script>

</body>
</html>

