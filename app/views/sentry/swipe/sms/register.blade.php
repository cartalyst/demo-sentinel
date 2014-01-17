@extends('template')

@section('title')
Register for SMS
@stop

@section('body')

<div class="container">

	<div class="page-header">
		<h1>Register for SMS</h1>
	</div>

	<p>Please enter your number (with country code). No spaces allowed.</p>

	{{ Form::open(['class' => 'form-horizontal']) }}

		<div class="form-group">
			<label for="number" class="col-sm-4 control-label">Number</label>
			<div class="col-sm-8">
				{{ Form::text('number', null, ['class' => 'form-control']) }}
			</div>
		</div>

		<div class="form-group">
			<label for="confirm-number" class="col-sm-4 control-label">Confirm Number</label>
			<div class="col-sm-8">
				{{ Form::text('number_confirmation', null, ['class' => 'form-control']) }}
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
