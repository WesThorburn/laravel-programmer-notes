<script type="text/javascript" src="http://localhost:8000/vendor/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
	tinymce.init({
		"selector":"#solution",
		"height":"450px",
		"language":"en",
		"theme":"modern",
		"skin":"lightgray",
		"menubar":"",
		"plugins":["advlist autolink link image lists charmap hr anchor pagebreak","searchreplace wordcount visualblocks visualchars fullscreen insertdatetime nonbreaking","save table contextmenu directionality template paste"],
		"toolbar":"undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist",
		"setup":function(ed) {
		    ed.on('keyup', function(e) {
		    	handleSave();
		    });
		}
	});

	var waitStatus = "ready";
	var timeoutHandle = setTimeout(function(){ 
		saveForm();
		waitStatus = "ready"; 
	}, 3000);

	function handleSave(){
		changeSaveButton('needsToBeSaved');
		if(waitStatus == "ready"){
			//console.log("Wait Status: "+waitStatus);

			waitStatus = "waiting";

			

			//console.log("Wait Status: "+waitStatus);
		}
		else if(waitStatus == "waiting"){
			clearTimeout(timeoutHandle);
		}
	}

	function changeSaveButton(saveStatus){
		if(saveStatus == "needsToBeSaved"){
			$('#saveButton').removeClass("colour-green");
			document.getElementById("saveButton").innerHTML = 'Save <span class="glyphicon glyphicon-floppy-disk">';
		} else if(saveStatus == "hasBeenSaved"){
			$('#saveButton').addClass("colour-green");
			document.getElementById("saveButton").innerHTML = 'Saved <span class="glyphicon glyphicon glyphicon-ok">';
		}
	}

	//Notes edit AJAX posting
	function saveForm(){
		var $form = $( this ),
			csrfToken = document.getElementsByName("_token")[0].value;
			problem = document.getElementById("problem").value;
			solution = tinyMCE.activeEditor.getContent();

		console.log(problem);

		var posting = $.post( "{{action('NoteController@update', ['id' => isset($selectedNote) ? $selectedNote->id : null])}}", { _method: 'put', _token: csrfToken, problem: problem, solution: solution } );

		posting.done(function( data ) {
			changeSaveButton("hasBeenSaved");
		});
	}
</script>