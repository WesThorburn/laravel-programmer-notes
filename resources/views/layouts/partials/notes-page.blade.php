<div class="col-md-3">
	<a href="/note/create" class="btn btn-primary">Create Note</a>
	<table id="notes-table">
		<thead>
			<tr>
				<th>Id</th>
				<th>Notes</th>
			</tr>
		</thead>
	</table>
</div>
<div class="col-md-9">
	@if(isset($showCreate))
		@include('layouts.partials.add-note-form')
	@elseif(isset($selectedNote))
		<!-- Display Note Display/Edit Form -->
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
					<button type="submit" class="btn btn-default pull-right">Update</button>
				</form>
				@include('layouts.partials.notes-status-messages')
			</div>
		</div>
	@endif
</div>

<script>
	$(document).ready(function(){
		var notesTable = $('#notes-table').DataTable({
			processing: true,
	        serverSide: true,
	        ajax: '/notesDataTable',
	        columns: [
				{data: 'id', name: 'id', "visible": false, searchable: false},
				{data: 'problem', name: 'problem', searchable: true},
			]
		});
		//Make table rows clickable
		$('#notes-table').delegate('tbody > tr', 'click', function(){
			var data = notesTable.row(this).data();
			window.location.assign('/note/'+ data.id)
		});
	});
</script>