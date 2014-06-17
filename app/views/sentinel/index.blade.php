@extends('template')

@section('body')

<div class="page-header">
	<h1>Sentinel</h1>
	<p class="lead">A framework agnostic authorization and authentication package featuring groups, permissions, custom hashing algorithms and additional security features.</p>
	<p  class="lead">This demo provides you a solid foundation of controllers and views for your next Application.</p>

	<p>
		<a href="https://github.com/cartalyst/demo-sentinel" class="btn btn-lg btn-default"><i class="fa fa-github"></i> Github</a>
		<a href="https://cartalyst.com/manual/sentinel" class="btn btn-lg btn-default"><i class="fa fa-github"></i> Documentation</a>
	</p>
	<p class="small">Documentation is in progress</p>
	<hr>

	<h2>What's new</h2>

	<ul class="list list-unstyled">
		<li>Allow for custom hashing strategies.</li>
		<li>Refactor permissions out into a driver-based system.</li>
		<li>Refactor *Provider and *Interface implementations into single *Repository classes, stripping methods and simplifying where possible.</li>
		<li>Multiple sessions.</li>
		<li>Multiple login columns.</li>
		<li>Inter-account throttling and improved DDoS protection.</li>
		<li>Improved integration with Laravel (Sentinel::basic(), easy email integration with queues).</li>
		<li>Improved speed - make use of eager loading.</li>
		<li>Allow use of implementations (such as Eloquent and Kohana ORM) to take place on the ORM level, without bloating Sentinel with abstractions never used by Sentinel.</li>
		<li>Add support for two factor authentication.</li>
		<li>Allow more flexible activation scenarios.</li>
	</ul>

	<h2>In Progress</h2>

	<ul class="list list-unstyled">
		<li>Renaming groups to roles to bring us inline with RBAC terminology.</li>
		<li>Sentinel Lance, oauth server extension</li>
		<li>Documentation</li>
	</ul>

</div>

@stop
