<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title></title>
</head>
<body>
<?php
	if(!empty($_REQUEST['direction']) && $_REQUEST['direction'] == "submit"){
		echo $_REQUEST['aa'];
	}
?>
<form method="post" action="" enctype="multipart/form-data">
    <textarea id="aa" name="aa" cols="30" rows="10">TEST</textarea>
	<script src="tinymce/tinymce.min.js"></script> 
    <script src="tinymce/plugins/emoticons/plugin.min.js"></script> 
    <script>
    tinymce.init({
        language 	: 'id',
        content_css : "a.css",
        selector	:"textarea#aa",
        plugins		: [
             "emoticons advlist autolink link image lists charmap print preview hr anchor pagebreak",
             "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
             "table contextmenu directionality emoticons paste textcolor responsivefilemanager code filemanager fullscreen insertdatetime"
       ],
       menubar : false,
       templates: [
        {title: 'Some title 1', description: 'Some desc 1', content: 'My content'},
        {title: 'Some title 2', description: 'Some desc 2', url: 'development.html'}
       ],
       toolbar1: "code template newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect | cut copy paste | searchreplace | bullist numlist | outdent indent blockquote",
                  toolbar2: "undo redo | link unlink anchor image media charmap emoticons | insertdatetime | forecolor backcolor | hr removeformat | subscript superscript | print preview fullscreen | ltr rtl | spellchecker | table visualchars visualblocks nonbreaking template pagebreak restoredraft",
    
       image_advtab: true ,
       external_filemanager_path:"http://localhost/tinymce/tinymce/plugins/filemanager/",
       filemanager_title:"File Manager" ,
       //external_plugins: { "wordcount" : "/wordcount/plugin.min.js"}
    });
    </script>
    <button type="submit" name="direction" value="submit">Submit</button>
</form>

</body>
</html>
