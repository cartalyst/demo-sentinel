@extends('template')

{{-- Page content --}}
@section('body')

<form method="post" action="">

	<div class="form-group">
		<label for="name">Name</label>
		<input type="text" class="form-control" name="name" id="name" value="{{ Input::old('name', $group->name) }}" placeholder="Enter the group name">
	</div>

	<div class="form-group">
		<label for="slug">Slug</label>
		<input type="text" class="form-control" name="slug" id="slug" value="{{ Input::old('slug', $group->slug) }}" placeholder="Enter the group name">
	</div>

	<button type="submit" class="btn btn-default">Submit</button>

</form>

@stop
