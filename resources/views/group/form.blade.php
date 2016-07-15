@extends('layouts.master')

@section('content')

@include('errors.default')

@if ($action === 'create')
{{ Form::open(array('route' => 'group.store', 'id' => 'groupForm')) }}
@else

{{ Form::model($group, array('route' => array('group.update', $group->id), 'method' => 'PUT', 'id'=>'group')) }}
@endif
<div class="row grpInfo" data-abide novalidate>
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
					<span class="form-error">This field is required.</span>
				</div>
			</div>
		</div>
	</fieldset>
</div>

<div class="row ownerInfo" data-abide novalidate>
	<fieldset class="fieldset">
		<legend>Owner Information</legend>
		<div class="small-3 columns">
			<div class="small-4 columns">
				{{ Form::label('netID', 'NetID', array('class' => 'text-right middle'))}}
			</div>
			<div class="small-8 columns">
				{{ Form::text('netID') }}
				<span class="form-error">This field is required.</span>
			</div>
		</div>
		<div class="small-4 columns">
			<div class="small-4 columns">
				{{ Form::label('firstName', 'First Name', array('class' => 'text-right middle'))}}
			</div>
			<div class="small-8 columns">
				{{ Form::text('firstName') }}
				<span class="form-error">This field is required.</span>
			</div>
		</div>
		<div class="small-4 columns">
			<div class="small-4 columns">
				{{ Form::label('lastName', 'Last Name', array('class' => 'text-right middle'))}}
			</div>
			<div class="small-8 columns">
				{{ Form::text('lastName') }}
				<span class="form-error">This field is required.</span>
			</div>
		</div>
		<div class="small-1 columns">
			{{ Form::button('Add', array('class' => 'hollow button', 
			   'onclick' => 'checkInput()')) }}
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

	{{ Form::button('Submit', array('class' => 'hollow button',
		'onclick'=> 'checkForm()')) }}

	&nbsp;&nbsp;&nbsp;

	{{ Form::button('Cancel', array('class' => 'hollow button',
		'onclick'=> 'goBack()')) }}
</div>

{{ Form::close() }}

@endsection

@section('prescript')
<script>
	$(function(){
		@if (count($errors) > 0)
			<?php
				$oldInput = Session::get('_old_input');
				if(array_key_exists('_netID', $oldInput)){
					$netID = $oldInput["_netID"];
        			$firstName =  $oldInput["_firstName"];
        			$lastName =  $oldInput["_lastName"];
        			foreach ($netID as $key => $value){ 
        	?>
        				addRow('{{$netID[$key]}}', '{{$firstName[$key]}}', '{{$lastName[$key]}}');
        	<?php	}
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
	  	//Foundation.Abide.defaults.liveValidate = true;
	  	$("[type=text]").prop("required","required");

	  	//$(document).on("formvalid.zf.abide", function(ev,elem){
	  		//$("#group").submit();
	  	//})
	});



     function addRow(netID, firstName, lastName){
     	var link = "<a href='#'' onclick='deleteRow(this)'>delete</a>";
     	
     	var row = $("<tr data-abide novalidate class='grpInfo'><td>"
     			  +"<input type='text' name='_netID[]' required value='"+netID+"'/>"
     			  +"<span class='form-error'>This field is required.</span>"
     			  +"</td><td>"
     			  +"<input type='text' name='_firstName[]' required value='"+firstName+"'/>"
     			  +"<span class='form-error'>This field is required.</span>"
     			  +"</td><td>"
     			  +"<input type='text' name='_lastName[]' required value='"+lastName+"'/>"
     			  +"<span class='form-error'>This field is required.</span>"
     			  +"</td><td>"+link
     			  +"</td></tr>");
     	var temp = $("tbody").append(row).foundation();
     }

     function deleteRow(obj){
     	$(obj).parents("tr").remove();
     }
     
</script>
@endsection

@section('postscript')
<script>
	function checkForm(){
     	//var result = $(".grpInfo").foundation("validateForm");

     	if(validate(".grpInfo")){
     		$("#groupForm").submit();
     	}
    }

    function checkInput(){
    	if(validate(".ownerInfo")){
     		addRow($("#netID").val(), $("#firstName").val(), $("#lastName").val());
    	}
    }

    function validate(str){
    	var elem = new Foundation.Abide($(str));
     	return elem.validateForm();
    }

    function goBack(){
    	<?php
		   $paginator = Session::get("paginator")		
        ?>
    	window.location.href = "{{ $paginator->url($paginator->currentPage()) }}";
    }
</script>
@endsection
