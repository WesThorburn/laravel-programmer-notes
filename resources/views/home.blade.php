@extends('layouts.app')

@section('content')
<div class="container margin-top-minus-20px">
    <div class="row">
    	<!-- Image Segment -->
        <div class="col-md-12 background-color-light-grey padding-left-right-0px">
        	<img class="img-responsive" src="images/homepage-image-main.jpg">
        	<h1 class="main-overlay-title text-center">A programmer's resource for storing and managing notes and processes.</h1>
        </div>
    

        <!-- Register Segment -->
        <div class="col-md-12 background-color-light-grey padding-top-20px padding-bottom-40px">
	        <div class="col-md-8 col-md-offset-2">
	        	<h2 class="sign-up-title text-center">Register to start creating your own notes! (It's free)</h2>
	        </div>
	        <div class="col-md-3 col-md-offset-5">
	        	<div class="center-block">
		        	<a href="/register" class="btn btn-primary btn-lg sign-up-button">Register</a>
		        </div>
	        </div>
	    </div>

        <!-- Search Public Notes Segment -->
        <div class="col-md-12 background-color-light-green padding-top-20px padding-bottom-40px">
	        <div class="col-md-8 col-md-offset-2">
	        	<h2 class="sign-up-title">Search public notes</h2>
	        	<div class="center-block">
		        	<div class="input-group">
						<input type="text" class="form-control input-lg" placeholder="Search" aria-describedby="search-glyph-addon">
						<span class="input-group-btn" id="search-glyph-addon">
							<button type="button" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-search"></span></button>
						</span>
					</div>
		        </div>
		        <p>Search by topic: Laravel, Apache, Git, Bootstrap... </p>
	        </div>
	    </div>
	</div>
</div>
@endsection
