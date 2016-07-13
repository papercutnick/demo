@if (count($errors) > 0)
<div class="row">
	<div class="alert callout" data-closable>
		<ul>
			@foreach ($errors->all() as $error)
			<li style="font-weight:bold">{{ $error }}</li>
			@endforeach
		</ul>
		<button class="close-button" aria-label="Dismiss alert" type="button" data-close>
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
</div>
@endif
