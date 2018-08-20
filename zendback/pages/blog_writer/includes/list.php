<?php defined('mainload') or die('Restricted Access'); ?>
<div class="x_title">
    <h2>Daftar <span class="title-highlight">Berita</span></h2>
    <div class="clearfix"></div>
</div>
<ul id="news_browser" class="filetree">
    <?php
	$t = 0;
    $qlink 	= $db->query("SELECT * FROM ".$tpref."posts ORDER BY ID_POST ASC");
    while($dt = $db->fetchNextObject($qlink)){
    $t++;
	$mox = $t%2;
	if($mox == 1){ $style = "background:#F5F5F5;"; }else{ $style = ""; }
	?>
        <li style=' <?php echo $style; ?> list-style:none; padding-left:5px;' id="li_<?php echo $dt->ID_POST; ?>" >
            <div id='link_list' >
                <p style="float:left" class="file">
                    <a href="javascript:void(0);" onclick="getparent('<?php echo $dt->ID_POST; ?>','divparent_id');" id="link_<?php echo $dt->ID_POST; ?>">
                        <?php echo $dt->TITLE; ?>
                    </a>              
                </p>
                <p class='buttons1' style="float:right">
                    <a href='<?php echo $dirhost; ?>/<?php echo $ajax_dir; ?>/preview.php?direction=preview&id_blog=<?php echo $dt->ID_POST; ?>' title="Preview" class="fancybox fancybox.ajax btn btn-default">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a href='javascript:void()' onclick="delete_link('<?php echo $dt->ID_POST; ?>');" title="Delete" class="btn btn-default">
                        <i class="fa fa-trash"></i>
                    </a>
                    <a href="<?php echo $lparam; ?>&direction=edit&no=<?php echo $dt->ID_POST; ?>" title="Edit" class="btn btn-default">
                       <i class="fa fa-pencil"></i>
                    </a> 
                </p>                 
                
             </div>
        </li>
        <br clear="all" />
    <?php } ?>	
</ul>
