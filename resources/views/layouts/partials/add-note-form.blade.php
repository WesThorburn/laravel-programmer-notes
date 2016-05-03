@include('layouts.partials.tinymce-solution-configuration')
<form role="form" action="{{action('NoteController@store')}}" method="POST">
	{{ csrf_field() }}
	<div class="col-xs-12">
		<input name="problem" id="problem" type="text" class="font-size-18px form-control{{ $errors->has('problem') ? ' has-error' : ''}}" 
		placeholder="What was the problem?">
	</div>
	<div class="col-xs-12 margin-top-10px">
		<textarea name="solution" id="solution" type="text" class="tinymce form-control{{ $errors->has('solution') ? ' has-error' : ''}}" 
		placeholder="How did you solve it?"></textarea>
	</div>
	<div class="padding-right-15px">
		<button type="submit" class="btn btn-default pull-right margin-top-10px">Save</button>
	</div>
</form>
@include('layouts.partials.notes-status-messages')
