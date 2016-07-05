@extends('layouts.master')

@section('content')
<table class="hover">
	<thead>
		<tr>
			<th>Action</th>
			<th>Group Name</th>
			<th>Group Owner</th>
			<th>Group Description</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($groups as $group)
		<tr>
			<td><a href="#">edit</a> / <a href="#">delete</a></td>
			<td>{{ $group->name }}</td>
			<td></td>
			<td>{{ str_limit($group->description,20) }}</td>
		</tr>
		@endforeach
	</tbody>
</table>

{{ $groups->links()}}
@endsection

@section('script')
$(document).foundation();
@endsection
