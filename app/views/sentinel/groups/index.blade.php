@extends('template')

{{-- Page content --}}
@section('body')

<div class="page-header">
	<h1>Groups <span class="pull-right"><a href="{{ URL::to('groups/create') }}" class="btn btn-warning">Create</a></span></h1>
</div>

@if ($groups->count())
Page {{ $groups->getCurrentPage() }} of {{ $groups->getLastPage() }}

<div class="pull-right">
	{{ $groups->links() }}
</div>

<br><br>

<table class="table table-bordered">
	<thead>
		<th class="col-lg-6">Name</th>
		<th class="col-lg-4">Slug</th>
		<th class="col-lg-2">Actions</th>
	</thead>
	<tbody>
		@foreach ($groups as $group)
		<tr>
			<td>{{ $group->name }}</td>
			<td>{{ $group->slug }}</td>
			<td>
				<a class="btn btn-warning" href="{{ URL::to("groups/{$group->id}") }}">Edit</a>
				<a class="btn btn-danger" href="{{ URL::to("groups/{$group->id}/delete") }}">Delete</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

Page {{ $groups->getCurrentPage() }} of {{ $groups->getLastPage() }}

<div class="pull-right">
	{{ $groups->links() }}
</div>
@else
<div class="well">

	Nothing to show here.

</div>
@endif

@stop
