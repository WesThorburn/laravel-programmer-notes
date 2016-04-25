<div class="col-md-3">
	<a href="/note/create" class="btn btn-primary">Create Note</a>
	<ul class="list-group">
		@foreach($notes as $note)
			<a href="/note/{{ $note->id }}" class="list-group-item @if(isset($selectedNote) && $selectedNote->id == $note->id) active @endif">{{ $note->problem }}</a>
		@endforeach
	</ul>
</div>
<div class="col-md-9">
	@if($showCreate)
		@include('layouts.partials.add-note-form')
	@else
		<div class="panel panel-default">
			<div class="panel-heading">
				{{ $selectedNote->problem }}
			</div>
			<div class="panel-body">
				{{ $selectedNote->solution }}
			</div>
		</div>
	@endif
</div>