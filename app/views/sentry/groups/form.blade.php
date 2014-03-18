@extends('template')

{{-- Page content --}}
@section('body')

<div class="page-header">
	<h1>{{ $mode == 'create' ? 'Create Group' : 'Update Group' }} <small>{{ $mode === 'update' ? $group->name : null }}</small></h1>
</div>

<form method="post" action="">

	<div class="form-group{{ $errors->first('name', ' has-error') }}">

		<label for="name">Name</label>

		<input type="text" class="form-control" name="name" id="name" value="{{ Input::old('name', $group->name) }}" placeholder="Enter the group name.">

		<span class="help-block">{{{ $errors->first('name', ':message') }}}</span>

	</div>

	<div class="form-group{{ $errors->first('slug', ' has-error') }}">

		<label for="slug">Slug</label>

		<input type="text" class="form-control" name="slug" id="slug" value="{{ Input::old('slug', $group->slug) }}" placeholder="Enter the group slug.">

		<span class="help-block">{{{ $errors->first('slug', ':message') }}}</span>

	</div>

	<button type="submit" class="btn btn-default">Submit</button>

</form>

@stop
