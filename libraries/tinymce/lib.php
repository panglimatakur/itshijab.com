<?php if(!empty($dirhost)){ $tinymce = $dirhost."/libraries/tinymce/"; } ?>
<script src="<?php echo @$tinymce; ?>tinymce/tinymce.min.js"></script> 
<script src="<?php echo @$tinymce; ?>tinymce/plugins/emoticons/plugin.min.js"></script> 
<script>
function show_editor(id_editor){
	tinymce.init({
		language 	: 'id',
		content_css : "<?php echo @$tinymce; ?>a.css",
		selector	: id_editor,
		//height 		: "480",
		plugins		: [
			 "emoticons advlist autolink link image lists charmap print preview hr anchor pagebreak",
			 "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
			 "table contextmenu directionality emoticons paste textcolor responsivefilemanager code filemanager fullscreen insertdatetime"
	   ],
	   menubar : false,
	   setup: function (ed) {
			id_editor = $(this).attr("id");
			ed.on("keyup",function (e) { 
				var body 		= $("#"+id_editor+"_ifr").contents().find("#tinymce");
				count = $("#character_count_"+id_editor).html();
				body_length 	= body.text();
				$("#character_count_"+id_editor).html(body_length.length);
				
			});
			
	   },
	   toolbar1					: "fullscreen code template newdocument fullpage | undo redo | cut copy paste |  searchreplace | styleselect formatselect fontselect fontsizeselect | preview print | ",
				  toolbar2		: "bold italic underline strikethrough | forecolor backcolor  removeformat  subscript superscript | alignleft aligncenter alignright alignjustify |  outdent indent blockquote | bullist numlist | link unlink anchor image media charmap emoticons  tables hr | insertdatetime |  ltr rtl spellchecker  visualchars visualblocks | nonbreaking template pagebreak restoredraft",
	   image_advtab				: true,
	   external_filemanager_path: "<?php echo @$tinymce; ?>tinymce/plugins/filemanager/",
	   filemanager_title		: "File Manager" ,
	});
}
</script>
