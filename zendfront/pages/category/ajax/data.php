<?php
session_start();
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

	if(!defined('mainload')) { define('mainload','ITSHIJAB',true); }
	include_once("../../../../includes/config.php");
	include_once("../../../../includes/classes.php");
	include_once("../../../../includes/functions.php");
	include_once("../../../../includes/declarations.php");
	$direction 		= isset($_REQUEST['direction']) ?	 $_REQUEST['direction'] 	: "";
	$id_kategori 	= isset($_REQUEST['id_kategori']) 	? $_REQUEST['id_kategori'] 	: "";
	$lastID 		= isset($_REQUEST['lastID']) 		? $_REQUEST['lastID'] 		: "";
	
	if(!empty($direction) && $direction == "list_report"){
		if(!empty($id_kategori)){
			$condition 		.= " AND ID_PRODUCT_CATEGORY = '".$id_kategori."'";  
		}
		
		$q_str 		 = "SELECT * FROM ".$tpref."products WHERE ID_PRODUCT IS NOT NULL ".$condition." AND ID_PRODUCT < '".$lastID."' ORDER BY ID_PRODUCT DESC LIMIT 0,24";
		$q_product 	 = $db->query($q_str);
		$num_product = $db->numRows($q_product);
		while($dt_product = $db->fetchNextObject($q_product)){
		$photo 		= $db->fob("PHOTOS",$tpref."products_photos"," WHERE ID_PRODUCT = '".$dt_product->ID_PRODUCT."'");
?>
            <div class="col-sm-3 wrdLatest" data-info='<?php echo $dt_product->ID_PRODUCT; ?>' id="tr_<?php echo $dt_product->ID_PRODUCT; ?>">
                <div class="product-image-wrapper">
                    <div class="single-products">
                            <div class="productinfo text-center">
                                <div style="height:180px; overflow:hidden">
                                    <?php if(!empty($photo) && is_file($basepath."/files/images/products/".$photo)){?>
                                    <img src="<?php echo $dirhost; ?>/files/images/products/<?php echo $photo; ?>" class="img-responsive"  alt="<?php echo $dt_product->NAME; ?>" title="<?php echo $dt_product->NAME; ?>"/>
                                    <?php }else{?>
                                    <img src="<?php echo $dirhost; ?>/files/images/no_image.jpg" class="img-responsive"  alt="<?php echo $dt_product->NAME; ?>" title="<?php echo $dt_product->NAME; ?>"/>
                                    <?php } ?>
                                </div>
                                <h2><?php echo money("Rp.",$dt_product->SALE_PRICE); ?></h2>
                                <p><?php echo $dt_product->NAME; ?></p>
                                <a href="<?php echo $dirhost; ?>/zendfront/pages/cart/page.php?id_product=<?php echo $dt_product->ID_PRODUCT; ?>" class="btn btn-default add-to-cart" data-toggle="modal" data-target="#shoppingCartModal" data-remote="false" data-title=""><i class="fa fa-shopping-cart"></i>Ke Troli</a>
                            </div>
                            <div class="product-overlay">
                                <div class="overlay-content">
                                    <h2><?php echo money("Rp.",$dt_product->SALE_PRICE); ?></h2>
                                    <p><?php echo $dt_product->NAME; ?></p>
                                    <a href="<?php echo $dirhost; ?>/zendfront/pages/cart/page.php?id_product=<?php echo $dt_product->ID_PRODUCT; ?>" class="btn btn-default add-to-cart" data-toggle="modal" data-target="#shoppingCartModal" data-remote="false" data-title=""><i class="fa fa-shopping-cart"></i>Ke Troli</a>
                                </div>
                            </div>
                    </div>
                    <div class="choose">
                        <ul class="nav nav-pills nav-justified">
							<?php if(!empty($_SESSION['uidkey'])){?>
                                <li><a href="javascript:void()" class="del_katalog" data-id="<?php echo $dt_product->ID_PRODUCT; ?>"><i class="fa fa-trash"></i>Hapus</a></li>
                            <?php } ?>
                            <li><a href="<?php echo $dirhost; ?>/detail/<?php echo $dt_product->ID_PRODUCT; ?>"><i class="fa fa-plus-square"></i>Detail</a></li>
                        </ul>
                    </div>
                </div>
            </div>
<?php 
		}
	}
}
?>