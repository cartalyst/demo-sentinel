@extends('template')

@section('title')
Register for Swipe
@stop

@section('body')

<div class="container">

	<div class="page-header">
		<h1>Register for Swipe</h1>
	</div>

	<p>Please download the Swift Identity app on your compatible device. When opened, login with the following one-time credentials. Once you have logged in, press continue.</p>

	<p><em>If you are already logged into Swift Identity with the below details on your device, just press continue.</em></p>

	<dl class="dl-horizontal">
		<dt>Login</dt>
		<dd><code>{{ $login }}</code></dd>
		<dt>Password</dt>
		<dd><code>{{ $code }}</code></dd>
	</dl>

	<p>
		<a href="{{ URL::to('swift/swipe/registered') }}" class="btn btn-primary">Continue</a>
	</p>

</div>

@stop
