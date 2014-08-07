@extends('template')

{{-- Page content --}}
@section('body')

<div class="page-header">
	<h1>{{ $mode == 'create' ? 'Create Role' : 'Update Role' }} <small>{{ $mode === 'update' ? $role->name : null }}</small></h1>
</div>

<form method="post" action="">

	<div class="form-group{{ $errors->first('name', ' has-error') }}">

		<label for="name">Name</label>

		<input type="text" class="form-control" name="name" id="name" value="{{ Input::old('name', $role->name) }}" placeholder="Enter the role name.">

		<span class="help-block">{{{ $errors->first('name', ':message') }}}</span>

	</div>

	<div class="form-group{{ $errors->first('slug', ' has-error') }}">

		<label for="slug">Slug</label>

		<input type="text" class="form-control" name="slug" id="slug" value="{{ Input::old('slug', $role->slug) }}" placeholder="Enter the role slug.">

		<span class="help-block">{{{ $errors->first('slug', ':message') }}}</span>

	</div>

	<button type="submit" class="btn btn-default">Submit</button>

</form>

@stop
