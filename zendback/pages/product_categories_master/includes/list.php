<?php defined('mainload') or die('Restricted Access'); ?>
<?php
function lchild($parent){
	global $db;
	global $lparam;
	global $ajax_dir;
	global $tpref;
	$qlink 	= $db->query("SELECT * FROM ".$tpref."products_categories WHERE ID_PARENT='".$parent."' ORDER BY SERI ASC");
	$jml 	= $db->numRows($qlink);
	if($jml >0){
?>
        <ul style="border-bottom:none">
<?php
		while($dt = $db->fetchNextObject($qlink)){
		?>
            <li style='list-style:none; padding:5px 0 0 15px; clear:both' id="li_<?php echo $dt->ID_PRODUCT_CATEGORY; ?>">
                <a href="javascript:void(0);" onclick="getparent('<?php echo $dt->ID_PRODUCT_CATEGORY; ?>','divparent_id');">
                    <i class="fa fa-check-square"></i> <?php echo $dt->NAME; ?>
                </a>
                <div class='pull-right'>
                    <a href='javascript:void()'  onclick="delete_link('<?php echo $dt->ID_PRODUCT_CATEGORY; ?>');" class="btn  btn-default" title="Delete">
                        <i class="fa fa-trash"></i>
                    </a>
                    <a href="<?php echo $lparam; ?>&direction=edit&no=<?php echo $dt->ID_PRODUCT_CATEGORY; ?>" class="btn  btn-default" title="Edit">
                       <i class="fa fa-pencil"></i>
                    </a>
                </div>
	  			<?php echo lchild($dt->ID_PRODUCT_CATEGORY); ?>
            </li>
		<?php
		}
?>
	</ul>
<?php
	}
}
?>
<ul id="browser" class="filetree" style="border-bottom:none">
    <?php
    $qlink 	= $db->query("SELECT * FROM ".$tpref."products_categories WHERE ID_PARENT='0' ORDER BY SERI ASC");
    while($dt = $db->fetchNextObject($qlink)){
	?>
        <li style='list-style:none; padding:5px 0 0 15px; clear:both;' id="li_<?php echo $dt->ID_PRODUCT_CATEGORY; ?>">
            <a href="javascript:void(0);" onclick="getparent('<?php echo $dt->ID_PRODUCT_CATEGORY; ?>','divparent_id');">
                <i class="fa fa-check-square"></i> <?php echo $dt->NAME; ?>
            </a>
            <div class='pull-right'>
                <a href='javascript:void()' onclick="delete_link('<?php echo $dt->ID_PRODUCT_CATEGORY; ?>');" class="btn btn-default" title="Delete">
                    <i class="fa fa-trash"></i>
                </a>
                <a href="<?php echo $lparam; ?>&direction=edit&no=<?php echo $dt->ID_PRODUCT_CATEGORY; ?>" class="btn btn-default" title="Edit">
                   <i class="fa fa-pencil"></i>
                </a>
            </div>
            <?php echo lchild($dt->ID_PRODUCT_CATEGORY); ?>
        </li>
    <?php } ?>	
        <br clear="all" />
</ul>
