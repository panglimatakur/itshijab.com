<?php $treeview = $dirhost."/libraries/treeview/"; ?>
<link rel="stylesheet" href="<?php echo $treeview; ?>css/jquery.treeview.css" />
<script src="<?php echo $treeview; ?>js/jquery.cookie.js" type="text/javascript"></script>
<script src="<?php echo $treeview; ?>js/jquery.treeview.js" type="text/javascript"></script>
<script language="javascript">
$(document).ready(function(){
	if($("#browser").length > 0){
		$("#browser").treeview({
			animated:"normal",
			persist: "cookie"
		});
	}
	if($("#cpanel_menu").length > 0){
		$("#cpanel_menu").treeview({
			animated:"normal",
			persist: "cookie"
		});
	}
	if($("#news_browser").length > 0){
		$("#news_browser").treeview({
			animated:"normal",
			persist: "cookie"
		});
	}
});
</script>
