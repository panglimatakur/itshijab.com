<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	session_start();
	if(!defined('mainload')) { define('mainload','ALIBABA',true); }
	include_once("../../../../includes/config.php");
	include_once("../../../../includes/classes.php");
	include_once("../../../../includes/functions.php");
	$display 		= isset($_REQUEST['display']) 			? $_REQUEST['display'] 			: "";
	$id_type 		= isset($_REQUEST['id_type']) 			? $_REQUEST['id_type'] 			: "";
	$id_type_report = isset($_REQUEST['id_type_report']) 	? $_REQUEST['id_type_report'] 	: "";
	$form_add		= isset($_REQUEST['form_add']) 			? $_REQUEST['form_add'] 		: ""; 
}else{
	defined('mainload') or die('Restricted Access');
}
function category_list($id_parent){
	global $db;
	global $tpref;
	global $dirhost;
	global $id_kategori;
	global $function;
	$query_kategori = $db->query("SELECT * FROM ".$tpref."products_categories WHERE ID_PARENT = '".$id_parent."' ORDER BY SERI"); 
?>
	<ul class="kategori_list list-inline" style="border-bottom:none;">
		<?php
		while($data_kategori = $db->fetchNextObject($query_kategori)){
			$class_selected = "";
			if(!empty($id_kategori) && $id_kategori == $data_kategori->ID_PRODUCT_CATEGORY){
				$class_selected = "class_selected";
				$style_selected = "background:#D5EAFF;";	
			}
		?>	
			<li id="cat_<?php echo $data_kategori->ID_PRODUCT_CATEGORY; ?>"  class="<?php echo $class_selected; ?> clist" style=" <?php echo @$style_selected; ?> width:100%; padding:6px 0 6px 9px">
				<i class="fa fa-folder"></i>
				<a href='javascript:void()' onclick="<?php echo $function; ?>('<?php echo $data_kategori->ID_PRODUCT_CATEGORY; ?>')">
					<?php echo $data_kategori->NAME; ?>
				</a>
                <?php echo category_list($data_kategori->ID_PRODUCT_CATEGORY); ?>
			</li>
		<?php } ?>
	</ul>
<?php	
}

function category_list_report($id_parent){
	global $db;
	global $tpref;
	global $dirhost;
	global $id_kategori_report;
	$query_kategori = $db->query("SELECT * FROM ".$tpref."products_categories WHERE ID_PARENT = '".$id_parent."' ORDER BY SERI"); 
?>
	<ul class="kategori_list list-inline widget_tally">
		<?php
		while($data_kategori = $db->fetchNextObject($query_kategori)){
			$class_selected = "";
			if(!empty($id_kategori_report) && $id_kategori_report == $data_kategori->ID_PRODUCT_CATEGORY){
				$class_selected = "class_selected";
				$style_selected = "background:#D5EAFF;";	
			}
		?>	
			<li id="cat_report_<?php echo $data_kategori->ID_PRODUCT_CATEGORY; ?>" class='<?php echo @$class_selected; ?>'  style="width:99%; border-bottom:none;padding:6px 0 6px 9px">
				<i class="fa fa-folder"></i>
				<a href='javascript:void()' onclick="select_category_report('<?php echo $data_kategori->ID_PRODUCT_CATEGORY; ?>')">
					<?php echo $data_kategori->NAME; ?>
				</a>
                <?php echo category_list_report($data_kategori->ID_PRODUCT_CATEGORY); ?>
			</li>
		<?php } ?>
	</ul>
<?php	
}
?>

<?php 
if((!empty($display) && $display == "kategori_proses") || !empty($id_type)){
	
    $query_kategori = $db->query("SELECT * FROM ".$tpref."products_categories WHERE ID_PRODUCT_TYPE='".$id_type."' AND ID_PARENT = '0' ORDER BY SERI");
	$num_kategori 	= $db->numRows($query_kategori);
	if($num_kategori > 0){
?>
<div class=" col-md-12">
    <input type="hidden" id="id_type" name="id_type" value="<?php echo $id_type; ?>" />
    <div class="x_panel">
        <div class="x_title">
            <h2>
                <?php if(empty($form_add)){ ?> Pilih <span class="title-highlight">Kategori</span> <?php }
                else{?>Pilih <span class="title-highlight">Kategori</span> Induk<?php } ?>
            </h2>
            <a href="javascrpt:void()" class='btn new_cat btn-danger pull-right' style="top:0;"  data-toggle="modal" data-target=".bs-example-modal-sm">
                <i class="fa fa-plus"></i>Tambah Kategori
            </a>
            <div class="clearfix"></div>
        </div>
        <div style="max-height:300px; overflow:scroll" >
                <?php if(empty($form_add)){ $function = "select_cat"; ?>
                <input type="hidden" name="id_kategori" id="id_kategori" class="form-control mousetrap" value="<?php echo @$id_kategori; ?>">
                <?php }else{ $function = "select_parent";?>
                    <input type="hidden" name="parent_id" id="parent_id" value="">
                <?php } ?>
                <?php
                while($data_kategori = $db->fetchNextObject($query_kategori)){
                    $class_selected = "";
                    if(!empty($id_kategori) && $id_kategori == $data_kategori->ID_PRODUCT_CATEGORY){
                        $class_selected = "class_selected";
                        $style_selected = "background:#D5EAFF;";	
                    } ?>	
                <ul class="kategori_list col-md-6" style="padding:6px;border:none;">
                    <li id="cat_<?php echo $data_kategori->ID_PRODUCT_CATEGORY; ?>"  class="<?php echo $class_selected; ?> clist" style=" <?php echo @$style_selected; ?> border:none;padding:6px 0 6px 6px">
                        <i class="fa fa-folder"></i>
                        <a href='javascript:void()' onclick="<?php echo $function; ?>('<?php echo $data_kategori->ID_PRODUCT_CATEGORY; ?>')">
                            <?php echo $data_kategori->NAME; ?>
                        </a>
                        <?php echo category_list($data_kategori->ID_PRODUCT_CATEGORY); ?>
                    </li>
                </ul>
                <?php } ?>
        </div>
    </div>
</div>
<?php 
	}
} 
?>

<?php 
if((!empty($display) && $display == "kategori_report") || !empty($id_type_report)){
    $query_kategori_report 	= $db->query("SELECT * FROM ".$tpref."products_categories WHERE ID_PRODUCT_TYPE='".$id_type_report."' AND ID_PARENT = '0' ORDER BY SERI");
	$num_kategori_report 	= $db->numRows($query_kategori_report);
	if($num_kategori_report > 0){
?>
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>
                    Pilih <span class="title-highlight">Kategori</span>
                </h2>
                <div class="clearfix"></div>
            </div>
            <input type="hidden" name="id_kategori_report" id="id_kategori_report" value="">
            <ul class="kategori_list_report list-inline widget_tally" style="padding:6px;">
                <?php
                while($data_kategori_report = $db->fetchNextObject($query_kategori_report)){
                        $class_selected = "";
                        if(!empty($id_kategori_report) && $id_kategori_report == $data_kategori_report->ID_PRODUCT_CATEGORY){
                            $class_selected = "class_selected";
                            $style_selected = "background:#D5EAFF;";	
                        }
                ?>	
                    <li id="cat_report_<?php echo $data_kategori_report->ID_PRODUCT_CATEGORY; ?>" class="<?php echo $class_selected; ?> clist" style=" <?php echo @$style_selected; ?> border-bottom:none;padding:6px 0 6px 6px">
                        <i class="fa fa-folder"></i>
                        <a href='javascript:void()' onclick="select_category_report('<?php echo $data_kategori_report->ID_PRODUCT_CATEGORY; ?>')">
                            <?php echo $data_kategori_report->NAME; ?>
                        </a>
                        <?php echo category_list_report($data_kategori_report->ID_PRODUCT_CATEGORY); ?>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
<?php 
	}
} 
if((!empty($display) && $display == "input_kategori")){ ?>
    
    <div class="form-group">
        <label class='req'>Nama Kategori</label>
        <input id="nama_kat" type="text" value="" class="form-control" style="text-transform:capitalize"/>
    </div>
    <div id="div_form_link" style="display:none">
        <div class="alert alert-info" style="margin:0">Apakah nama kategori diatas,  adalah jenis kategori anak (subkategori) atau jenis kategori induk (kategori) ?</div>
        <div class="form-group">
            <label class='req'>Jenis Kategori</label>
            <select id="kategori_type"  class="form-control">
                <option value="induk">Kategori Induk</option>
                <option value="anak">Kategori Anak</option>
            </select>
        </div>
        <span id="div_kategori_induk"></span>
    </div>
    <span id="div_new_kat"></span>
    <div class="form-group">
        <button type="submit"  id="new_category" value="new_category">Simpan Kategori</button>
    </div>
<?php } ?>