@section('meta')
	@if(isset($selectedNote))
		@if($selectedNote->private)
			<META NAME="robots" CONTENT="noindex">
		@endif
	@endif
@stop

<div class="col-xs-12 col-sm-4 col-md-3 padding-left-right-0px col-sm-md-lg-padding-right-15px">
	@if(Auth::user())
		<div class="padding-left-0px">
			<input type="text" class="font-size-18px" id="noteSearchField" placeholder="Search notes">
		</div>
		<div class="padding-left-0px">
			<a href="/note/create" class="margin-top-10px btn btn-primary"><span class="glyphicon glyphicon-plus margin-right-5px"></span> Create A New Note</a>
		</div>
	@endif
	<table id="notes-table" class="margin-top-10px table-hover responsive" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>Id</th>
				@if(!Auth::user())
					<th>Other Notes by {{ $selectedNote->user->name }}</th>
				@elseif(isset($selectedNote) && Auth::user()->id == $selectedNote->user_id)
					<th>Your Existing Notes</th>
				@elseif(isset($selectedNote) && Auth::user()->id != $selectedNote->id)
					<th>Other Notes by {{ $selectedNote->user->name }}</th>
				@else
					<th>Existing Notes</th>
				@endif
				<th>Last Updated</th>
			</tr>
		</thead>
	</table>
</div>
<div class="col-xs-12 col-sm-8 col-md-9 padding-left-right-0px col-xs-margin-top-20px">
	@if(isset($showCreate))
		<!-- Create New Note -->
		@include('layouts.partials.add-note-form')
	@elseif(isset($selectedNote) && $readOnly)
		<!-- View Note (Read Only) -->
		<div class="panel panel-default">
            <div class="panel-heading">{{ $selectedNote->problem }}</div>
            <div class="panel-body">
                {!! $selectedNote->solution !!}
            </div>
        </div>
    @elseif(isset($selectedNote))
		<!-- Edit Existing Note -->
		@include('layouts.partials.tinymce-solution-configuration')
		<div class="input-group">
			<input name="problem" id="problem" type="text" class="font-size-18px form-control{{ $errors->has('problem') ? ' has-error' : ''}}" 
			placeholder="What was the problem?" value="{{ $selectedNote->problem }}" onkeyup="handleSave()">
			<span class="input-group-btn">
				<button class="btn btn-default" id="settingsButton" type="button" data-toggle="modal" data-target="#settingsModal"><span class="glyphicon glyphicon-cog"></span></button>
				<button class="btn btn-default" id="saveButton" type="button" onclick="saveForm()">Save <span class="glyphicon glyphicon-floppy-disk"></span></button>
			</span>
		</div>

		<div class="margin-top-10px">
			<textarea name="solution" id="solution" type="text" class="form-control{{ $errors->has('solution') ? ' has-error' : '' }}" width="99%"
			placeholder="How did you solve it?">{{ $selectedNote->solution }}</textarea>
		</div>
		@include('layouts.partials.notes-status-messages')
		@include('layouts.partials.settings-modal')
	@endif
</div>

<script>
	//Notes list display
	$(document).ready(function(){
		var currentNoteUserId = '<?php 
			if(isset($selectedNote)){ 
				echo $selectedNote->user_id;
			}
			elseif(isset($publicNote)){
				echo $publicNote->user_id;
			}?>';

		var notesTable = $('#notes-table').DataTable({
			dom: 'tp',
			responsive: true,
			lengthMenu: [10],
			order: [[2, "desc"]],
			processing: true,
	        serverSide: true,
	        ajax: '/notesDataTable/'+ currentNoteUserId + '/<?php echo isset($selectedNote) || isset($publicNote) ? $selectedNote->id : null ?>',
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