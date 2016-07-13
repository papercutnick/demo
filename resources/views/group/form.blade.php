@extends('layouts.master')

@section('content')

@include('errors.default')

@if ($action === 'create')
{{ Form::open(array('route' => 'group.store')) }}
@else

{{ Form::model($group, array('route' => array('group.update', $group->id), 'method' => 'PUT')) }}
@endif

<div class="row">
	<fieldset class="fieldset">
		<legend>Group Information</legend>
		<div class="small-6 columns">
			<div class="row">
				<div class="small-4 columns">
					{{ Form::label('name', 'Group Name', array('class' => 'text-right middle'))}}
				</div>
				<div class="small-8 columns">
					{{ Form::text('name') }}
					<span class="form-error">This field is required.</span>
				</div>
			</div>
		</div>
		<div class="small-6 columns">
			<div class="row">
				<div class="small-4 columns">
					{{ Form::label('description', 'Group Description', array('class' => 'text-right middle'))}}
				</div>
				<div class="small-8 columns">
					{{ Form::text('description') }}
				</div>
			</div>
		</div>
	</fieldset>
</div>

<div class="row">
	<fieldset class="fieldset">
		<legend>Owner Information</legend>
		<div class="small-3 columns">
			<div class="small-4 columns">
				{{ Form::label('netID', 'NetID', array('class' => 'text-right middle'))}}
			</div>
			<div class="small-8 columns">
				{{ Form::text('netID') }}
			</div>
		</div>
		<div class="small-4 columns">
			<div class="small-4 columns">
				{{ Form::label('firstName', 'First Name', array('class' => 'text-right middle'))}}
			</div>
			<div class="small-8 columns">
				{{ Form::text('firstName') }}
			</div>
		</div>
		<div class="small-4 columns">
			<div class="small-4 columns">
				{{ Form::label('lastName', 'Last Name', array('class' => 'text-right middle'))}}
			</div>
			<div class="small-8 columns">
				{{ Form::text('lastName') }}
			</div>
		</div>
		<div class="small-1 columns">
			{{ Form::button('Add', array('class' => 'hollow button', 
			   'onclick' => 'addRow($("#netID").val(), $("#firstName").val(), $("#lastName").val())')) }}
		</div>
	</fieldset>
</div>

<div class="row">
	<table class="hover">
		<thead>
			<tr>
				<th>NetID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>

	{{ Form::submit('Submit', array('class' => 'hollow button')) }}
</div>

{{ Form::close() }}

@endsection

@section('script')
<script>
	$(function(){
		@if (count($errors) > 0)
			<?php
				$oldInput = Session::get('_old_input');
				if(array_key_exists('_netID', $oldInput)){
					$netID = $oldInput["_netID"];
        			$firstName =  $oldInput["_firstName"];
        			$lastName =  $oldInput["_lastName"];
        			foreach ($netID as $key => $value){ ?>
        				addRow('{{$netID[$key]}}', '{{$firstName[$key]}}', '{{$lastName[$key]}}');
        	<?php		}
        		}
			?>
		@else
	  		@if ($action === 'edit')
	  			@foreach ($group->owners()->get() as $owner)
					addRow('{{$owner->netid}}', '{{$owner->first_name}}', '{{$owner->last_name}}');
				@endforeach
	  		@endif
	  	@endif

	  	//initialize js validation
	  	//$("form").prop({"data-abide":"data-abide","novalidate":"novalidate"});
	  	$("form").prop("data-abide","data-abide");
	  	$("[type=text]").prop("required","required");
	});

     function addRow(netID, firstName, lastName){
     	var link = "<a href='#'' onclick='deleteRow(this)'>delete</a>";
     	
     	var row = "<tr><td>"
     			  +"<input type='text' name='_netID[]' value='"+netID+"' />"
     			  +"</td><td>"
     			  +"<input type='text' name='_firstName[]' value='"+firstName+"' />"
     			  +"</td><td>"
     			  +"<input type='text' name='_lastName[]' value='"+lastName+"' />"
     			  +"</td><td>"+link
     			  +"</td></tr>";
     	$("tbody").append(row);
     }

     function deleteRow(obj){
     	$(obj).parents("tr").remove();
     }
</script>
@endsection
