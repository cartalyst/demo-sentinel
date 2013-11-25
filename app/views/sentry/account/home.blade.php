@extends('template')

@section('title')
My Account
@stop

@section('body')

<div class="container">

	<div class="page-header">
		<h1>My Account</h1>
	</div>

	<div class="row">
		<div class="col-md-6">
			<h3>
				My Logged In Sessions
				<small>Click to Kill</small>
			</h3>

			<div class="list-group">
				@foreach ($user->getPersistenceCodes() as $index => $code)
					@if ($code == $persistence->check())
						<a href="{{ URL::to("account/kill/{$code}") }}" class="list-group-item active">
							Session #{{ $index + 1 }}
							<span class="badge">You</span>
						</a>
					@else
						<a href="{{ URL::to("account/kill/{$code}") }}" class="list-group-item">
							Session #{{ $index + 1 }}
						</a>
					@endif
				@endforeach
			</div>

			{{ Carbon\Carbon::now() }}
		</div>
	</div>

</div>

@stop
