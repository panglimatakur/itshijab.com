<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	define('mainload','ITSHIJAB',true);
	include_once("../../../../includes/config.php");
	include_once("../../../../includes/classes.php");
	$parent_id		=	$_REQUEST['parent_id'];
	$qchild			=	$db->query("SELECT * FROM system_pages_client WHERE ID_PAGE_CLIENT='".$parent_id."'");
	$dtchild		=	$db->fetchNextObject($qchild);
	$no 			= 	$dtchild->ID_PAGE_CLIENT;
	$nama_parent	= 	$dtchild->NAME;
}
else{  defined('mainload') or die('Restricted Access'); }
?>
<div class="alert alert-info" style="width:100%">
   Di bawah adalah Halaman anak dari halaman <?php echo "<b><u>".$nama_parent."</u></b>"; ?>
    <a href='javascript:void();' onclick='resetchild();' style="float:right; margin-top:-8px">
        <i class="icsw16-trashcan"></i>
    </a>
</div>
<input type="hidden" name="parent_id" value='<?php echo @$parent_id; ?>' id='parent_id'/>
