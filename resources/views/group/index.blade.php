@extends('layouts.master')

@section('content')


<a href="{{ route('group.create') }}">Create New Group</a>

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
			<td>
                <a href="#">edit</a> / <a href="#" onclick="$(this).next('form').submit()">delete</a>
                {{ Form::open(array('action' => array('GroupController@destroy', $group->id), 'method' => 'DELETE')) }}
                {{ Form::close() }}
            </td>
			<td>{{ $group->name }}</td>
			<td>
				<?php
					$owners = $group->owners()->get();
					$ownerName = '';

					foreach ($owners as $owner){
						$ownerName .= ($owner->first_name).';';
					}
				?>

				{{ str_limit($ownerName,20) }}
			</td>
			<td>{{ str_limit($group->description,20) }}</td>
		</tr>
		@endforeach
	</tbody>
</table>

<a href="{{ route('group.create') }}">Create New Group</a>

@include('pagination.default', ['paginator' => $groups])

{{-- route('group.destroy', ['group' => $group->id, '_method'=>'DELETE']) --}}

@endsection

@section('script')
@endsection
