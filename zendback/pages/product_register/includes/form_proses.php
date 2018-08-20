<?php defined('mainload') or die('Restricted Access'); ?>
<form id="formID" class="formular" action="" method="POST" enctype="multipart/form-data">
	<input type="hidden" id="code_random" value="<?php echo $code_random; ?>"/>
    <div class=" col-md-6">
        <div class="form-group">
            <label class="req">Tipe Produk</label>
            <select name="id_type" id="id_type" class=" mousetrap form-control" onchange="show_catlist('')"/>
                <option value=''>--PILIH TIPE PRODUK--</option>
                <?php
                $query_type = $db->query("SELECT * FROM ".$tpref."products_types ORDER BY ID_PRODUCT_TYPE ASC");
                while($data_type = $db->fetchNextObject($query_type)){
                ?>
                    <option value='<?php echo $data_type->ID_PRODUCT_TYPE ?>' <?php if(!empty($id_type) && $id_type == $data_type->ID_PRODUCT_TYPE){?> selected<?php } ?>><?php echo $data_type->NAME; ?>
                    </option>
            <?php } ?>
            </select>
        </div>
    </div>
    <span id="div_kategori">
        <?php if(!empty($id_type)){ include $call->inc($ajax_dir,"kategori.php"); } ?>
    </span>
    <div class="<?php if(empty($direction) || (!empty($direction) && $direction != "edit")){?>col-md-6<?php }else{ ?>col-md-12<?php } ?>">
        <div class="form-group">
          <label class="req">Gambar Item</label>
          <span id='elements'></span>
           <input type="file" name="image[]" id="image_1" onchange="preview(this,'<?php echo @$direction; ?>')" style="height:50px" multiple class="mousetrap form-control"> 
        </div>
    </div>

   <div class="form-group <?php if(empty($direction) || (!empty($direction) && $direction != "edit")){?>col-md-12<?php }else{ ?>col-md-6<?php } ?>" id="preview_zone" style="clear:both; margin-top:20px;">
    <?php
    if(!empty($direction) && ($direction == "insert" || $direction == "edit" || $direction == "save")){
        if(!empty($no)){?>
    <?php
            $q_photos 	= $db->query("SELECT * FROM ".$tpref."products_photos WHERE ID_PRODUCT='".$no."'");
            $dt_photos = $db->fetchNextObject($q_photos);
            if(is_file($basepath."/files/images/products/".$dt_photos->PHOTOS)){
    ?>
                  <div class="product_content col-md-12" style=" text-align:center" id="product_<?php echo $no; ?>">
                    <a href="javascript:void()" class="close_button btn" onClick="cancel_content('<?php echo $no; ?>','<?php echo $dt_photos->ID_PRODUCT_PHOTO; ?>','<?php echo @$direction; ?>')"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
                   
                    <a href='<?php echo $dirhost; ?>/files/images/products/<?php echo $dt_photos->PHOTOS; ?>' class='fancybox'>
                        <img src="<?php echo $dirhost; ?>/files/images/products/<?php echo $dt_photos->PHOTOS; ?>" style="width:100%; height:auto" class="thumbnail"/>
                    </a>
                  </div>
    <?php 
                }
        }
    } ?>
   </div>
	<?php
		if(!empty($direction) && $direction == "edit"){
			$display 					= "form_edit";
			$button_container_style 	= '';
			$multi_button_style 		= 'style="display:none"';
			$button_multiple_form		= 'style="display:none"';
			include $call->inc($inc_dir,"form_edit.php"); 
		}else{
			$button_container_style 	= 'style="display:none"';
		}
	?>
    <div id="satuan_tag" style='display:none'>
            <option value=''>--PILIH SATUAN--</option>
            <?php
            $query_unit = $db->query("SELECT * FROM ".$tpref."products_units ORDER BY NAME");
            while($data_unit = $db->fetchNextObject($query_unit)){
            ?>
                <option value='<?php echo $data_unit->ID_PRODUCT_UNIT; ?>'><?php echo $data_unit->NAME; ?>
                </option>
        <?php } ?>
    </div>
    <div class="col-md-12" id="button_container" <?php echo $button_container_style; ?>>
        <?php
        if(empty($direction) || 
		(!empty($direction) && ($direction != "edit" || $direction != "show" || $direction != "export"))){
            $prosesvalue = "insert";	
        }
        if(!empty($direction) && ($direction != "insert" || $direction != "delete" || $direction != "show" || $direction != "export")){
            $prosesvalue = "save";
            $addbutton = "
                <a href='".$lparam."'>
                    <input name='button' type='button' class='btn btn-warning' value='Tambah Data Baru'  style='margin-top:8px'>
                </a>";
    ?>
        <input type='hidden' name='no' id='no' value='<?php echo $no; ?>' />
        <?php
        }
    ?>
        <button name="direction" id="direction" type="submit" class="btn btn-primary" value="<?php echo $prosesvalue; ?>" style="margin:0">Simpan Data</button>
    	<a href="<?php echo $ajax_dir; ?>/data.php?display=multiple_form" class="fancybox fancybox.ajax" style="margin:0 5px 0 0"  >
        </a>
        <?php echo @$addbutton; ?>
        <input type="hidden" name="counter" id="counter" value="<?php @$counter; ?>"/>
    </div>
</form>
