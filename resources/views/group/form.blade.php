@extends('layouts.master')

@section('content')

{{ Form::open(array('route' => 'group.store')) }}

<div class="row">
	<fieldset class="fieldset">
		<legend>Group Information</legend>
		<div class="small-6 columns">
			<div class="row">
				<div class="small-4 columns">
					{{ Form::label('name', 'Group Name', array('class' => 'text-right middle'))}}
				</div>
				<div class="small-8 columns">
					{{ Form::text('name','', array('required' => '')) }}
				</div>
			</div>
		</div>
		<div class="small-6 columns">
			<div class="row">
				<div class="small-4 columns">
					{{ Form::label('description', 'Group Description', array('class' => 'text-right middle'))}}
				</div>
				<div class="small-8 columns">
					{{ Form::text('description','', array('required' => '')) }}
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
			{{ Form::button('Add', array('class' => 'hollow button', 'onclick' => 'addRow()')) }}
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
     function addRow(){
     	var link = "<a href='#'' onclick='deleteRow(this)'>delete</a>";
     	
     	var row = "<tr><td>"+$("#netID").val()
     			  +"<input type='hidden' name='_netID[]' value='"+$("#netID").val()+"' />"
     			  +"</td><td>"+$("#firstName").val()
     			  +"<input type='hidden' name='_firstName[]' value='"+$("#firstName").val()+"' />"
     			  +"</td><td>"+$("#lastName").val()
     			  +"<input type='hidden' name='_lastName[]' value='"+$("#lastName").val()+"' />"
     			  +"</td><td>"+link
     			  +"</td></tr>";
     	$("tbody").append(row);
     }

     function deleteRow(obj){
     	$(obj).parents("tr").remove();
     }
</script>
@endsection
