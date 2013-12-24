@extends('template')

@section('body')

<div class="row">

	<div class="col-lg-6">

		<div class="panel panel-default">
			<div class="panel-body">
				Login into your account
				<p></p>
				<a class="btn btn-info" href="{{ URL::to('login') }}">Login</a>
			</div>
		</div>

	</div>

	<div class="col-lg-6">

		<div class="panel panel-default">
			<div class="panel-body">
				Create a new user
				<p></p>
				<a class="btn btn-info" href="{{ URL::to('register') }}">Register</a>
			</div>
		</div>

	</div>

</div>

@stop
