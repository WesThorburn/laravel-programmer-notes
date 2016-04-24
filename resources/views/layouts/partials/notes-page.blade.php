<div class="panel panel-default">
	<div class="panel-heading">
		Add a Note
	</div>
	<div class="panel-body">
		<!-- Name -->
		<form role="form" action="{{action('NoteController@store')}}" method="POST">
			{{ csrf_field() }}
			<label class="col-xs-3 text-right" for="problem">Problem</label>
			<div class="col-xs-7">
				<textarea name="problem" id="problem" type="text" class="form-control{{ $errors->has('problem') ? ' has-error' : ''}}" 
				placeholder="What was the problem?"></textarea>
			</div>
			<label class="col-xs-3 text-right" for="name">Solution</label>
			<div class="col-xs-7">
				<textarea name="solution" id="solution" type="text" class="form-control{{ $errors->has('solution') ? ' has-error' : ''}}" 
				placeholder="How did you solve it?"></textarea>
			</div>
			<div class="col-xs-2 pull-left">
				<button type="submit" class="btn btn-default">Save</button>
			</div>
		</form>
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
					<ul>
			            <li>{{ Session('noteSaveSuccess') }}</li>
			        </ul>
				</div>
			</div>
		@endif
	</div>
</div>