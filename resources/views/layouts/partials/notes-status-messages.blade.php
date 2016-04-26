@if($errors->has('problem') || $errors->has('solution'))
	<div class="col-xs-12 quarter-margin-top">
		<div class="alert alert-danger three-quarter-margin-bottom">
			<ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
		</div>
	</div>
@endif
@if(Session::has('noteSaveSuccess'))
	<div class="col-xs-12 quarter-margin-top">
		<div class="alert alert-success three-quarter-margin-bottom">
			<p>{{ Session('noteSaveSuccess') }}</p>
		</div>
	</div>
@elseif(Session::has('noteSaveError'))
	<div class="col-xs-12 quarter-margin-top">
		<div class="alert alert-danger three-quarter-margin-bottom">
			<p>{{ Session('noteSaveError') }}</p>
		</div>
	</div>
@endif