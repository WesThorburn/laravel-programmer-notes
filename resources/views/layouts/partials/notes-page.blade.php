<div class="col-xs-12 col-sm-4 col-md-3 padding-left-right-0px col-sm-md-lg-padding-right-15px">
	<div class="padding-left-0px">
		<a href="/note/create" class="btn btn-primary">Create Note</a>
	</div>
	<div class="padding-left-0px">
		<input type="text" class="margin-top-10px font-size-18px" id="noteSearchField" placeholder="Search notes">
	</div>
	<table id="notes-table" class="margin-top-10px table-hover responsive" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>Id</th>
				<th>Existing Notes</th>
				<th>Last Updated</th>
			</tr>
		</thead>
	</table>
</div>
<div class="col-xs-12 col-sm-8 col-md-9 padding-left-right-0px col-xs-margin-top-20px">
	@if(isset($showCreate))
		@include('layouts.partials.add-note-form')
	@elseif(isset($selectedNote))
		@include('layouts.partials.tinymce-solution-configuration')
		<!-- Display Note Display/Edit Form -->
		<form role="form" id="noteForm" action="{{action('NoteController@update', ['id' => $selectedNote->id])}}" method="POST">
			<input type="hidden" name="_method" value="put"/>
			{{ csrf_field() }}

			<div class="input-group">
				<input name="problem" id="problem" type="text" class="font-size-18px form-control{{ $errors->has('problem') ? ' has-error' : ''}}" 
				placeholder="What was the problem?" value="{{ $selectedNote->problem }}" onkeyup="setTimeout(saveForm, 3000)">
				<span class="input-group-btn">
					<button class="btn btn-default" id="settingsButton" type="button" data-toggle="modal" data-target="#settingsModal"><span class="glyphicon glyphicon-cog"></span></button>
					<button class="btn btn-default" id="saveButton" type="button">Save <span class="glyphicon glyphicon-floppy-disk"></span></button>
				</span>
			</div>

			<div class="margin-top-10px">
				<textarea name="solution" id="solution" type="text" class="form-control{{ $errors->has('solution') ? ' has-error' : '' }}" width="99%"
				placeholder="How did you solve it?">{{ $selectedNote->solution }}</textarea>
			</div>

			<button type="submit" class="btn btn-default pull-right margin-top-10px">Update</button>
		</form>
		@include('layouts.partials.notes-status-messages')
	@endif
</div>

@include('layouts.partials.settings-modal')

<script>
	//Notes list display
	$(document).ready(function(){
		var notesTable = $('#notes-table').DataTable({
			dom: 'tp',
			responsive: true,
			lengthMenu: [10],
			order: [[2, "desc"]],
			processing: true,
	        serverSide: true,
	        ajax: '/notesDataTable/'+'<?php echo isset($selectedNote) ? $selectedNote->id : null ?>',
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

	//Notes edit AJAX posting
	function saveForm(){
		var $form = $( this ),
			csrfToken = document.getElementsByName("_token")[0].value;
			problem = document.getElementById("problem").value;
			solution = document.getElementById("solution").value;

		console.log(csrfToken);
		console.log(problem);
		console.log(solution);

		var posting = $.post( "{{action('NoteController@update', ['id' => isset($selectedNote) ? $selectedNote->id : null])}}", { _method: 'put', _token: csrfToken, problem: problem, solution: solution } );

		posting.done(function( data ) {
			changeSaveButton("hasBeenSaved");
		});
	}
</script>