<?php defined('mainload') or die('Restricted Access'); ?>
<div class="col-md-12" >
    <div class="x_panel">
        <div class="x_title">
            <h2>Pencarian <span class="title-highlight">Halaman</span></h2>
            <div class="clearfix"></div>
        </div>
   
        <form name="form1" method="post" action="" enctype="multipart/form-data" class="t-box shadow">
           <div  class="form-group col-md-6">
            <label>Menu Induk</label>
            <select name="root_id" id="root_id" class='form-control'>
                  <option value=''>--LINK ROOT--</option>
                  <?php
                  $qmod = $db->query("SELECT * FROM system_pages_client WHERE ID_PARENT = '0'");
                  while($dtmod = $db->fetchNextObject($qmod)){
                  ?>
                    <option value='<?php echo $dtmod->ID_PAGE_CLIENT; ?>' <?php if(!empty($root_id) && $dtmod->ID_PAGE_CLIENT == $root_id){ ?> selected <?php } ?>>
                    <?php echo $dtmod->NAME; ?>
                    </option>
                  <?PHP } ?>
             </select>    
           </div>
           <div  class="form-group col-md-6">
            <button type="submit" name="direction" value="show" class='btn btn-primary' style="margin-top:25px; color:#FFF"/>Lihat Halaman</button>
            <input type='hidden' id='proses_page' value='<?php echo $dirhost; ?>/<?php echo $ajax_dir; ?>/save.php' />
          </div>
        </form>
	</div>
</div> 
<div class="col-md-12" >
    <div class="x_panel">
        <div class="x_title">
            <h2>Daftar <span class="title-highlight">Halaman</span></h2>
            <div class="clearfix"></div>
        </div>
		<?php
        if(!empty($direction)){
            $cond = "";
            if(!empty($root_id)){ 	$cond = " AND ID_PARENT='".$root_id."'"; }else{ $cond = " AND ID_PARENT='0'"; }
			
			if(!empty($root_id)){?>
				<div class="alert alert-info">Menu anak dari Menu
				<strong><u><?php echo strtoupper($db->fob("NAME","system_pages_client","WHERE ID_PAGE_CLIENT = '".$root_id."'")); ?></u></strong>
				</div>
			<?php } 
        ?>
        <div  class="col-md-6">
            <div id="contentLeft">
                <ul>
                    <?php
                    $query  = "SELECT * FROM system_pages_client WHERE ID_PAGE_CLIENT != '' ".$cond." ORDER BY SERI ASC";
                    $result = $db->query($query);
                    
                    while($dt_menu = $db->fetchNextObject($result)){
                    ?>
                        <li id="recordsArray_<?php echo $dt_menu->ID_PAGE_CLIENT; ?>">
							<?php echo $dt_menu->ID_PAGE_CLIENT; ?>. <?php echo $dt_menu->NAME; ?>
                        	<?php echo lchild($dt_menu->ID_PAGE_CLIENT); ?>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div  class="col-md-6">
            <div id="contentRight">
            </div>
        </div>
        <?php } ?>
    </div>
</div>
