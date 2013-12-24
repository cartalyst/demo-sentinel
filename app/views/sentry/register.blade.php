@extends('template')

@section('title')
Register
@stop

@section('body')

<div class="page-header">
	<h1>Register</h1>
</div>

{{ Form::open(array('class' => 'form-horizontal')) }}

	<div class="form-group{{ $errors->has('email') ? ' has-error' : null }}">
		<label for="email" class="col-sm-4 control-label">Email</label>
		<div class="col-sm-8">
			{{ Form::email('email', null, array('class' => 'form-control')) }}
			<p class="help-block">{{ $errors->first('email') }}</p>
		</div>
	</div>

	<div class="form-group{{ $errors->has('password') ? ' has-error' : null }}">
		<label for="password" class="col-sm-4 control-label">Password</label>
		<div class="col-sm-8">
			{{ Form::password('password', array('class' => 'form-control')) }}
			<p class="help-block">{{ $errors->first('password') }}</p>
		</div>
	</div>

	<div class="form-group{{ $errors->has('password') ? ' has-error' : null }}">
		<label for="password_confirm" class="col-sm-4 control-label">Confirm Password</label>
		<div class="col-sm-8">
			{{ Form::password('password_confirm', array('class' => 'form-control')) }}
			<p class="help-block">{{ $errors->first('password_confirm') }}</p>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8 col-sm-push-4">
			{{ Form::submit('Register', array('class' => 'btn btn-primary')) }}
			{{ Form::reset('Reset', array('class' => 'btn btn-default')) }}
		</div>
	</div>

{{ Form::close() }}

@stop
