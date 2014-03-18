@extends('template')

{{-- Page content --}}
@section('body')

<div class="page-header">
	<h1>Users <span class="pull-right"><a href="{{ URL::to('users/create') }}" class="btn btn-warning">Create</a></span></h1>
</div>

@if ($users->count())
Page {{ $users->getCurrentPage() }} of {{ $users->getLastPage() }}

<div class="pull-right">
	{{ $users->links() }}
</div>

<br><br>

<table class="table table-bordered">
	<thead>
		<th class="col-lg-6">Name</th>
		<th class="col-lg-4">Email</th>
		<th class="col-lg-2">Actions</th>
	</thead>
	<tbody>
		@foreach ($users as $user)
		<tr>
			<td>{{ $user->first_name }} {{ $user->last_name }}</td>
			<td>{{ $user->email }}</td>
			<td>
				<a class="btn btn-warning" href="{{ URL::to("users/{$user->id}") }}">Edit</a>
				<a class="btn btn-danger" href="{{ URL::to("users/{$user->id}/delete") }}">Delete</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

Page {{ $users->getCurrentPage() }} of {{ $users->getLastPage() }}

<div class="pull-right">
	{{ $users->links() }}
</div>
@else
<div class="well">

	Nothing to show here.

</div>
@endif

@stop
