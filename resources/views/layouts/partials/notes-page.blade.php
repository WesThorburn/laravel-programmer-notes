<div class="col-md-3">
	<a href="/note/create" class="btn btn-primary">Create Note</a>
	<ul class="list-group">
		@foreach($notes as $note)
			<a href="/note/{{ $note->id }}" class="list-group-item @if(isset($selectedNote) && $selectedNote->id == $note->id) active @endif">{{ $note->problem }}</a>
		@endforeach
	</ul>
</div>
<div class="col-md-9">
	@if(isset($showCreate))
		@include('layouts.partials.add-note-form')
	@elseif(isset($selectedNote))
		<div class="panel panel-default">
			<div class="panel-heading">
				Detail a solution to a problem you've encountered...
			</div>
			<div class="panel-body">
				@include('tinymce::tpl', ['els' => ['note']])
				<form role="form" action="{{action('NoteController@update', ['id' => $selectedNote->id])}}" method="POST">
					<input type="hidden" name="_method" value="put"/>
					{{ csrf_field() }}
					<div class="col-xs-12">
						<input name="problem" id="problem" type="text" class="form-control{{ $errors->has('problem') ? ' has-error' : ''}}" 
						placeholder="What was the problem?" value="{{ $selectedNote->problem }}">
					</div>
					<div class="col-xs-12">
						<textarea name="solution" id="solution" type="text" class="tinymce form-control{{ $errors->has('solution') ? ' has-error' : ''}}" 
						placeholder="How did you solve it?">{{ $selectedNote->solution }}</textarea>
					</div>
					<button type="submit" class="btn btn-default">Update</button>
				</form>
			</div>
		</div>
	@endif
</div>