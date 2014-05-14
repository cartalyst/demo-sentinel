@extends('template')

@section('body')

<div class="page-header">
	<h1>Sentry 3</h1>
	<p class="lead">A framework agnostic authorization and authentication package featuring groups, permissions, custom hashing algorithms and additional security features.</p>
	<p  class="lead">This demo provides you a solid foundation of controllers and views for your next Application.</p>

	<p>
		<a href="https://github.com/cartalyst/demo-sentry" class="btn btn-lg btn-default"><i class="fa fa-github"></i> Github</a>
		<button class="btn btn-default btn-lg" data-toggle="modal" data-target="#modal">
			<i class="fa fa-heart"></i> Consider this
		</button>

	</p>
	<hr>
	<h2>What's new</h2>

	<p><b>Documentation for Sentry 3 is still in progress.</b></p>

	<ul class="list list-unstyled">
		<li>Allow for custom hashing strategies.</li>
		<li>Refactor permissions out into a driver-based system.</li>
		<li>Refactor `*Provider` and `*Interface` implementations into single `*Repository` classes, stripping methods and simplifying where possible.</li>
		<li>Multiple sessions.</li>
		<li>Multiple login columns.</li>
		<li>Inter-account throttling and improved DDoS protection.</li>
		<li>Improved integration with Laravel (`Sentry::basic()`, easy email integration with queues).</li>
		<li>Improved speed - make use of eager loading.</li>
		<li>Allow use of implementations (such as Eloquent and Kohana ORM) to take place on the ORM level, without bloating Sentry with abstractions never used by Sentry.</li>
		<li>Add support for two factor authentication.</li>
		<li>Allow more flexible activation scenarios.</li>
	</ul>

</div>

<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
			<p class="lead">Don’t be a mooch! Put in a pull request, help with documentation, or support the cause by subscribing to <a href="https://cartalyst.com">Cartalyst</a>.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@stop
