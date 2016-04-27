@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
        	@if(\Auth::user())
        		@include('layouts.partials.notes-page')
	        @else
	        	<div class="panel panel-default">
	                <div class="panel-heading">Welcome</div>
	                <div class="panel-body">
	                    Your Application's home Page.
	                </div>
	            </div>
	        @endif
            
        </div>
    </div>
</div>
@endsection
