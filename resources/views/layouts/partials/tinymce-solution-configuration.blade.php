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
		        console.log('onkeyup event detected, this is the textarea contents: ' + ed.getContent());
		    });
		}
	});
	</script>