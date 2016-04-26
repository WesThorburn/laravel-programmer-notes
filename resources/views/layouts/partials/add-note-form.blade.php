<div class="panel panel-default">
	<div class="panel-heading">
		Detail a solution to a problem you've encountered...
	</div>
	<div class="panel-body">
		@include('tinymce::tpl', ['els' => ['note']])
		<form role="form" action="{{action('NoteController@store')}}" method="POST">
			{{ csrf_field() }}
			<label class="col-xs-1" for="problem">Problem</label>
			<div class="col-xs-11">
				<input name="problem" id="problem" type="text" class="form-control{{ $errors->has('problem') ? ' has-error' : ''}}" 
				placeholder="What was the problem?">
			</div>
			<label class="col-xs-1" for="name">Solution</label>
			<div class="col-xs-11">
				<textarea name="solution" id="solution" type="text" class="tinymce form-control{{ $errors->has('solution') ? ' has-error' : ''}}" 
				placeholder="How did you solve it?"></textarea>
			</div>
			<div class="col-xs-1 col-xs-offset-11">
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