@extends('template')

{{-- Page content --}}
@section('body')

<div class="page-header">
	<h1>Roles <span class="pull-right"><a href="{{ URL::to('roles/create') }}" class="btn btn-warning">Create</a></span></h1>
</div>

@if ($roles->count())
Page {{ $roles->getCurrentPage() }} of {{ $roles->getLastPage() }}

<div class="pull-right">
	{{ $roles->links() }}
</div>

<br><br>

<table class="table table-bordered">
	<thead>
		<th class="col-lg-6">Name</th>
		<th class="col-lg-4">Slug</th>
		<th class="col-lg-2">Actions</th>
	</thead>
	<tbody>
		@foreach ($roles as $role)
		<tr>
			<td>{{ $role->name }}</td>
			<td>{{ $role->slug }}</td>
			<td>
				<a class="btn btn-warning" href="{{ URL::to("roles/{$role->id}") }}">Edit</a>
				<a class="btn btn-danger" href="{{ URL::to("roles/{$role->id}/delete") }}">Delete</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

Page {{ $roles->getCurrentPage() }} of {{ $roles->getLastPage() }}

<div class="pull-right">
	{{ $roles->links() }}
</div>
@else
<div class="well">

	Nothing to show here.

</div>
@endif

@stop
