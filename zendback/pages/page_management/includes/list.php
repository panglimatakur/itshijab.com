<?php defined('mainload') or die('Restricted Access'); ?>
<div class="x_title">
    <h2>Daftar <span class="title-highlight">Halaman</span></h2>
    <div class="clearfix"></div>
</div>

<?php
function lchild($parent){
	global $db;
	global $lparam;
	global $ajax_dir;
	
	$qlink 	= $db->query("SELECT * FROM system_pages_client WHERE ID_PARENT='".$parent."' ORDER BY SERI ASC");
	$jml 	= $db->numRows($qlink);
	if($jml >0){
?>
	<ul>
<?php
		$t = 0;
		while($dt = $db->fetchNextObject($qlink)){
		$t++;
		$mox = $t%2;
		if($mox == 1){ $style = "background:#F5F5F5;"; }else{ $style = ""; }
		if($dt->IS_FOLDER == 1){ $class = "folder"; }else{ $class = "file"; }
		?>
            <li style=' <?php echo $style; ?> 
            			list-style:none; 
                        padding-left:5px;' 
                		id="li_<?php echo $dt->ID_PAGE_CLIENT; ?>">
                <div id='link_list'>
                    <p style="float:left" class="<?php echo $class; ?>">
                        <a href="javascript:void(0);" onclick="getparent('<?php echo $dt->ID_PAGE_CLIENT; ?>','divparent_id');" id="link_<?php echo $dt->ID_PAGE_CLIENT; ?>" data-info="<?php echo $dt->ID_MODULE; ?>">
                            [<?php echo $dt->ID_PAGE_CLIENT; ?>] <?php echo " <b style='color:#990000'>(".$dt->TYPE.")</b> - ".$dt->NAME; ?>
                        </a>
                    </p>
                    <p class='buttons1' style="float:right;margin:0">
                        <a href='javascript:void()' onclick="delete_link('<?php echo $dt->ID_PAGE_CLIENT; ?>');" title="Delete" class="btn btn-default">
                            <i class="fa fa-trash"></i>
                        </a>
                        <a href="<?php echo $lparam; ?>&direction=edit&no=<?php echo $dt->ID_PAGE_CLIENT; ?>" title="Edit" class="btn btn-default">
                           <i class="fa fa-pencil"></i>
                        </a>        
                    </p>
                    <div class="clear"></div>
                </div>		
	  			<?php echo lchild($dt->ID_PAGE_CLIENT); ?>
            </li>
		<?php
		}
?>
	</ul>
<?php
	}
}
?>
<ul id="browser" class="filetree">
    <?php
	$t = 0;
	$id_module_list = "";
    $qlink 	= $db->query("SELECT * FROM system_pages_client WHERE ID_PAGE_CLIENT IS NOT NULL AND ID_PARENT='0' ORDER BY ID_MODULE ASC, SERI ASC");
    while($dt = $db->fetchNextObject($qlink)){
    $t++;
	$mox = $t%2;
	if($mox == 1){ $style = "background:#F5F5F5;"; }else{ $style = ""; }
	if($dt->IS_FOLDER == 1){ $class = "folder"; }else{ $class = "file"; }
	?>
        <?php if($dt->ID_MODULE != $id_module_list){?>
        <li id="li_w" style="height:40px">
        	<?php 
				if($dt->ID_MODULE == 1){  echo "&nbsp;<h2 style='margin:-29px 0 0 -20px;padding:10px; background:#CCCCCC'><b>Module Website</b></h2>"; }
				if($dt->ID_MODULE== 2) {  echo "&nbsp;<h2 style='margin:-29px 0 0 -20px;padding:10px; background:#CCCCCC'><b>Module Admin		</b></h2>"; }
			?>
            <br clear="all" />
        </li>
        <?php } ?>
        <li style=' <?php echo $style; ?> list-style:none; padding-left:5px;' id="li_<?php echo $dt->ID_PAGE_CLIENT; ?>">
            <div id='link_list' >
                <p style="float:left" class="<?php echo $class; ?>">
                    <a href="javascript:void(0);" onclick="getparent('<?php echo $dt->ID_PAGE_CLIENT; ?>','divparent_id');" id="link_<?php echo $dt->ID_PAGE_CLIENT; ?>" data-info="<?php echo $dt->ID_MODULE; ?>">
                        [<?php echo $dt->ID_PAGE_CLIENT; ?>] <?php echo " <b style='color:#990000'>(".$dt->TYPE.")</b> - ".$dt->NAME; ?>
                    </a>              
                </p>
                <p class='buttons1' style="float:right;margin:0">
                    <?php //if($dt->TYPE != "dinamis"){ ?>
                    <a href='javascript:void()' onclick="delete_link('<?php echo $dt->ID_PAGE_CLIENT; ?>');" title="Delete" class="btn btn-default">
                        <i class="fa fa-trash"></i>
                    </a>
                    <?php //} ?>
                    <a href="<?php echo $lparam; ?>&direction=edit&no=<?php echo $dt->ID_PAGE_CLIENT; ?>" title="Edit" class="btn btn-default">
                       <i class="fa fa-pencil"></i>
                    </a> 
                </p>                 
                
             </div>
             <div class="clear"></div>
            <?php echo lchild($dt->ID_PAGE_CLIENT); ?>
        </li>
        <div class="clear"></div>
    <?php	$id_module_list	= $dt->ID_MODULE;  } ?>	
</ul>
