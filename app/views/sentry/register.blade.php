@extends('template')

@section('title')
Register
@stop

@section('body')

<div class="container">

	<div class="page-header">
		<h1>Register</h1>
	</div>

	{{ Form::open(['class' => 'form-horizontal']) }}

		<div class="form-group">
			<label for="email" class="col-sm-4 control-label">Email</label>
			<div class="col-sm-8">
				{{ Form::email('email', null, ['class' => 'form-control']) }}
			</div>
		</div>

		<div class="form-group">
			<label for="password" class="col-sm-4 control-label">Password</label>
			<div class="col-sm-8">
				{{ Form::password('password', ['class' => 'form-control']) }}
			</div>
		</div>

		<div class="form-group">
			<label for="password-confirmation" class="col-sm-4 control-label">Confirm Password</label>
			<div class="col-sm-8">
				{{ Form::password('password_confirmation', ['class' => 'form-control']) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-8 col-sm-push-4">
				{{ Form::submit('Register', ['class' => 'btn btn-lg btn-primary']) }}
				{{ Form::reset('Reset', ['class' => 'btn btn-default']) }}
			</div>
		</div>

	{{ Form::close() }}
</div>

@stop
