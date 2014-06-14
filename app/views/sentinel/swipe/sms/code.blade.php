@extends('template')

@section('title')
Enter SMS Code
@stop

@section('body')

<div class="container">

	<div class="page-header">
		<h1>Enter SMS Code</h1>
	</div>

	<p>Please enter the SMS code you received. If you don't receive a code in the next couple of minutes, please <a href="{{ URL::to('swift/sms/register') }}">try again</a>.</p>

	{{ Form::open(['class' => 'form-horizontal']) }}

		<div class="form-group">
			<label for="code" class="col-sm-4 control-label">Code</label>
			<div class="col-sm-8">
				{{ Form::text('code', null, ['class' => 'form-control']) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-8 col-sm-push-4">
				{{ Form::submit('Continue', ['class' => 'btn btn-lg btn-primary']) }}
				{{ Form::reset('Reset', ['class' => 'btn btn-default']) }}
			</div>
		</div>

	{{ Form::close() }}

</div>

@stop
