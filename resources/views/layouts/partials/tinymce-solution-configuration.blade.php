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

	function handleSave(){
		changeSaveButton('needsToBeSaved');
		setTimeout(saveForm, 3000);
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
</script>