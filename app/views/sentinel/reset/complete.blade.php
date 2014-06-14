@extends('template')

@section('title')
Reset Password
@stop

@section('body')

<div class="container">

	<div class="page-header">
		<h1>Reset Password</h1>
	</div>

	{{ Form::open(['class' => 'form-horizontal']) }}

		<div class="form-group">
			<label for="password" class="col-sm-4 control-label">New Password</label>
			<div class="col-sm-8">
				{{ Form::password('password', ['class' => 'form-control']) }}
			</div>
		</div>

		<div class="form-group">
			<label for="password-confirmation" class="col-sm-4 control-label">Confirm New Password</label>
			<div class="col-sm-8">
				{{ Form::password('password_confirmation', ['class' => 'form-control']) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-8 col-sm-push-4">
				{{ Form::submit('Reset', ['class' => 'btn btn-lg btn-primary']) }}
			</div>
		</div>

	{{ Form::close() }}
</div>

@stop
