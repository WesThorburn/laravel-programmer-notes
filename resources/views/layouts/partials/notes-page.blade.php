<div class="col-xs-12 col-sm-4 col-md-3 padding-left-right-0px col-sm-md-lg-padding-right-15px">
	<div class="padding-left-0px">
		<a href="/note/create" class="btn btn-primary">Create Note</a>
	</div>
	<div class="padding-left-0px">
		<input type="text" class="margin-top-10px" id="noteSearchField" placeholder="Search notes">
	</div>
	<table id="notes-table" class="margin-top-10px table-hover responsive" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>Id</th>
				<th>Notes</th>
				<th></th>
			</tr>
		</thead>
	</table>
</div>
<div class="col-xs-12 col-sm-8 col-md-9 padding-left-right-0px col-xs-margin-top-20px">
	@if(isset($showCreate))
		@include('layouts.partials.add-note-form')
	@elseif(isset($selectedNote))
		<!-- Display Note Display/Edit Form -->
		@include('tinymce::tpl', ['els' => ['note']])
		<form role="form" action="{{action('NoteController@update', ['id' => $selectedNote->id])}}" method="POST">
			<input type="hidden" name="_method" value="put"/>
			{{ csrf_field() }}

			<input name="problem" id="problem" type="text" class="form-control{{ $errors->has('problem') ? ' has-error' : ''}}" 
			placeholder="What was the problem?" value="{{ $selectedNote->problem }}">

			<div class="margin-top-10px">
				<textarea name="solution" id="solution" type="text" class="tinymce form-control{{ $errors->has('solution') ? ' has-error' : ''}}" 
				placeholder="How did you solve it?">{{ $selectedNote->solution }}</textarea>
			</div>

			<div class="padding-right-15px">
				<button type="submit" class="btn btn-default pull-right margin-top-10px">Update</button>
			</div>
		</form>
		@include('layouts.partials.notes-status-messages')
	@endif
</div>

<script>
	$(document).ready(function(){
		var notesTable = $('#notes-table').DataTable({
			dom: 'tp',
			responsive: true,
			lengthMenu: [10],
			order: [[2, "desc"]],
			processing: true,
	        serverSide: true,
	        ajax: '/notesDataTable/'+'<?php echo $selectedNote->id ?>',
	        columns: [
				{data: 'id', name: 'id', "visible": false, searchable: false},
				{data: 'problem', name: 'problem', searchable: true},
				{data: 'updated_at', name: 'updated_at', "visible": false, searchable: true},
			]
		});
		//Make table rows clickable
		$('#notes-table').delegate('tbody > tr', 'click', function(){
			var data = notesTable.row(this).data();
			window.location.assign('/note/'+ data.id)
		});

		//Notes Search Field
		oTable = $('#notes-table').DataTable();
		$('#noteSearchField').keyup(function(){
			oTable.search($(this).val()).draw();
		});
	});
</script>