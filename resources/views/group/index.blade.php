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
			<td>
				<?php
					$owners = $group->owners()->get();
					$ownerName = '';

					foreach ($owners as $owner){
						$ownerName .= ($owner->name).';';
					}
				?>

				{{ str_limit($ownerName,20) }}
			</td>
			<td>{{ str_limit($group->description,20) }}</td>
		</tr>
		@endforeach
	</tbody>
</table>

@include('pagination.default', ['paginator' => $groups])

@endsection

@section('script')
$(document).foundation();
@endsection
