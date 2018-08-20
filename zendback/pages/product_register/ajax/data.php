<?php
session_start();
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	if(!defined('mainload')) { define('mainload','ALIBABA',true); }
	include_once("../../../../includes/config.php");
	include_once("../../../../includes/classes.php");
	include_once("../../../../includes/functions.php");
	include_once("../../../../includes/declarations.php");

	$id_type 		= isset($_REQUEST['id_type']) 			? $_REQUEST['id_type'] : "";
	$id_parent 		= isset($_REQUEST['id_parent']) 		? $_REQUEST['id_parent'] : "";
	$display 		= isset($_REQUEST['display']) 			? $_REQUEST['display'] : "";
	$add_new 		= isset($_REQUEST['add_new']) 			? $_REQUEST['add_new'] : "";

	if((!empty($display) && $display == "list_report")){
		@$lastID 	= $_REQUEST['lastID'];
		
		if(!empty($_REQUEST['id_kategori_report']))	{ $id_kategori_report 	= $sanitize->number($_REQUEST['id_kategori_report']); 	}
		if(!empty($_REQUEST['code_report']))		{ $code_report 			= $sanitize->str($_REQUEST['code_report']); 			}
		if(!empty($_REQUEST['nama_report']))		{ $nama_report 			= $sanitize->str($_REQUEST['nama_report']); 			}
		if(!empty($_REQUEST['satuan_report']))		{ $satuan_report 		= $sanitize->str($_REQUEST['satuan_report']); 			}
		if(!empty($_REQUEST['deskripsi_report']))	{ $deskripsi_report 	= $sanitize->str($_REQUEST['deskripsi_report']); 		}
	
		$condition = "";
		if(!empty($id_type_report))		{ $condition 	.= "AND ID_PRODUCT_TYPE 	= '".$id_type_report."' "; 		}
		if(!empty($id_kategori_report))	{ $condition 	.= "AND ID_PRODUCT_CATEGORY = '".$id_kategori_report."' "; 		}
		if(!empty($code_report))		{ $condition 	.= "AND CODE 				= '".$code_report."' "; 			}
		if(!empty($nama_report))		{ $condition 	.= "AND NAME				LIKE '%".$nama_report."%' "; 		}
		if(!empty($deskripsi_report))	{ $condition 	.= "AND DESCRIPTION 		LIKE '%".$deskripsi_report."%' "; 	}
	
		$query_str	= "SELECT * FROM ".$tpref."products WHERE ID_PRODUCT < ".$lastID." ORDER BY ID_PRODUCT DESC ";
		$q_produk 	= $db->query($query_str."  LIMIT 0,10");
		$num_produk	= $db->recount($query_str);
		  while($dt_produk = $db->fetchNextObject($q_produk)){ 
			@$photo				= $db->fob("PHOTOS",$tpref."products_photos"," WHERE ID_PRODUCT = '".$dt_produk->ID_PRODUCT."'");
			@$unit				= $db->fob("NAME",$tpref."products_units"," WHERE ID_PRODUCT_UNIT='".$dt_produk->ID_PRODUCT_UNIT."'");
			//@$stock				= $db->fob("STOCK",$tpref."products_stocks"," WHERE ID_PRODUCT='".$dt_produk->ID_PRODUCT."'"); 
			if(empty($stock)){ $stock = 0; }
		  ?>
		  <tr class="wrdLatest" data-info='<?php echo $dt_produk->ID_PRODUCT; ?>' id="tr_<?php echo $dt_produk->ID_PRODUCT; ?>">
			<td><input type="checkbox" name="row_sel" class="row_sel" value="<?php echo $dt_produk->ID_PRODUCT; ?>"/></td>
			<td style="width:60px">
				<?php if(!empty($photo) && is_file($basepath."/files/images/products/thumbnails/".$photo)){ ?>
				<a href="<?php echo $ajax_dir; ?>/produk.php?no=<?php echo $dt_produk->ID_PRODUCT; ?>" title="Image 01" class="fancybox fancybox.ajax">
					<img src='<?php echo $dirhost; ?>/files/images/products/thumbnails/<?php echo $photo; ?>' class='photo' style="width:98%"/>
				</a>
				<?php }else{ ?>
					<img src='<?php echo $dirhost; ?>/files/images/no_image.jpg' class='photo' style="width:98%"/>
				<?php } ?>
			</td>
			<td style="vertical-align:top">
                <div class="x_panel">
                <table width="100%" border="0" class="tbl_item">
                  <tr>
                    <td width="13%"><b>Kode Item </b></td>
                    <td width="87%"><?php echo $dt_produk->CODE; ?></td>
                  </tr>
                  <tr>
                    <td><b>Nama</b></td>
                    <td><?php echo $dt_produk->NAME; ?></td>
                  </tr>
                  <tr>
                    <td><b>Harga</b></td>
                    <td><?php echo money("Rp.",$dt_produk->SALE_PRICE); ?></td>
                  </tr>
                  <?php if(!empty($dt_produk->DESCRIPTION)){?>
                  <tr>
                    <td><b>Deskripsi </b></td>
                    <td><?php echo printtext($dt_produk->DESCRIPTION,50); ?></td>
                  </tr>
                  <?php } ?>
			  </table>
              </div>
		   </td>
			<td style="vertical-align:top; text-align:center">
				<div class="btn-group">
					<a href="<?php echo $lparam; ?>&direction=edit&no=<?php echo $dt_produk->ID_PRODUCT; ?>" class="btn btn-default" title="Edit">
						<i class="fa fa-pencil"></i>
					</a>
					<a href="<?php echo $dirhost; ?>/<?php echo $ajax_dir; ?>/produk.php?no=<?php echo $dt_produk->ID_PRODUCT; ?>" title="<?php echo $dt_produk->NAME; ?>" class="fancybox fancybox.ajax btn btn-default">
						<i class="fa fa-eye"></i>
					</a>
					<a href='javascript:void()' onclick="removal('<?php echo $dt_produk->ID_PRODUCT; ?>')" class="btn btn-default" title="Delete">
						<i class="fa fa-trash"></i>
					</a>
				</div>
                <br />
                <br />
                <select id="st_prod_<?php echo $dt_produk->ID_PRODUCT; ?>" onchange="set_status('<?php echo $dt_produk->ID_PRODUCT; ?>')">
                    <option value="">-- STATUS TAMPIL --</option>
                    <option value="1" <?php if(!empty($st_status) && $st_status == "1"){?> selected <?php } ?>>NON AKTIF</option>
                    <option value="2" <?php if(!empty($st_status) && $st_status == "2"){?> selected <?php } ?>>AKTIF</option>
                </select>
			</td>
		</tr>
		<?php } 
	}
	
}
?>
