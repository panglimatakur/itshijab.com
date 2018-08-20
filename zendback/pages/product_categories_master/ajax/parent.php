<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	session_start();
		define('mainload','ITSHIJAB',true);
		include_once("../../../../includes/config.php");
		include_once("../../../../includes/classes.php");
		$parent_id		=	$_REQUEST['parent_id'];
		$qchild			=	$db->query("SELECT * FROM ".$tpref."products_categories WHERE ID_PRODUCT_CATEGORY='".$parent_id."'");
		$dtchild		=	$db->fetchNextObject($qchild);
		$no 			= 	$dtchild->ID_PRODUCT_CATEGORY;
		$nama_parent	= 	$dtchild->NAME;
}
else{  defined('mainload') or die('Restricted Access'); }
?>
<input type="hidden" name="parent_id" value='<?php echo $parent_id; ?>' id='parent_id'/>
<div class="alert alert-info">
    Di bawah adalah Kategori anak dari <?php echo "<b><u>".$nama_parent."</u></b>"; ?>
    <a href='javascript:void();' onclick='resetchild();' style="float:right; margin-top:-8px" class="btn btn-primary">
        <i class="fa fa-close"></i>
    </a>
</div>
