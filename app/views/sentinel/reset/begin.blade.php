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
			<label for="email" class="col-sm-4 control-label">Email</label>
			<div class="col-sm-8">
				{{ Form::email('email', null, ['class' => 'form-control']) }}
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
