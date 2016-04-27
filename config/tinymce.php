<?php

return [

	'cdn' => Config('app.url').':8000/vendor/js/tinymce/tinymce.min.js',

	'default' => [
		"selector" => ".tinymce",
		"language" => 'en',
		"theme" => "modern",
		"skin" => "lightgray",
		"plugins" => [
	         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
	         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
	         "save table contextmenu directionality emoticons template paste textcolor"
		],
		"toolbar" => "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
	],

	'note' => [
		"selector" => "#solution",
		"height" => "450px",
		"language" => 'en',
		"theme" => "modern",
		"skin" => "lightgray",
		"menubar" => "",
		"plugins" => [
	         "advlist autolink link image lists charmap hr anchor pagebreak",
	         "searchreplace wordcount visualblocks visualchars fullscreen insertdatetime nonbreaking",
	         "save table contextmenu directionality template paste"
		],
		"toolbar" => "undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist",
	],
];