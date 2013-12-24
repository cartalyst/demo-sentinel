@extends('template')

@section('title')
Login
@stop

@section('body')

<div class="page-header">
	<h1>Login</h1>
</div>

{{ Form::open(array('class' => 'form-horizontal', 'autocomplete' => 'off')) }}

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

	<div class="form-group">
		<div class="col-sm-8 col-sm-push-4">
			<label>
				{{ Form::checkbox('remember') }}
				Remember me
			</label>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8 col-sm-push-4">
			{{ Form::submit('Login', array('class' => 'btn btn-primary')) }}
			{{ Form::reset('Reset', array('class' => 'btn btn-default')) }}
			<a href="{{ URL::to('reset') }}">Forgot password?</a>
		</div>
	</div>

{{ Form::close() }}

@stop
