<?php defined('mainload') or die('Restricted Access'); ?>
<style type="text/css">
.paging_box{
	padding:10px;
	margin-bottom:6px;
	text-decoration:none;	
}
</style>
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Produk Terbaru</h2>

<?php while($dt_product = $db->fetchNextObject($q_product)){
	$photo 		= $db->fob("PHOTOS",$tpref."products_photos"," WHERE ID_PRODUCT = '".$dt_product->ID_PRODUCT."'");
?>
    <div class="col-sm-3 wrdLatest" data-info='<?php echo $dt_product->ID_PRODUCT; ?>' id="tr_<?php echo $dt_product->ID_PRODUCT; ?>">
        <div class="product-image-wrapper">
            <div class="single-products">
                    <div class="productinfo text-center">
                        <div style="height:180px; overflow:hidden">
							<?php if(!empty($photo) && is_file($basepath."/files/images/products/".$photo)){?>
                            <img src="<?php echo $dirhost; ?>/files/images/products/<?php echo $photo; ?>" class="img-responsive" alt="<?php echo $dt_product->NAME; ?>" title="<?php echo $dt_product->NAME; ?>"/>
                            <?php }else{?>
                            <img src="<?php echo $dirhost; ?>/files/images/no_image.jpg" class="img-responsive"  alt="<?php echo $dt_product->NAME; ?>" title="<?php echo $dt_product->NAME; ?>"/>
                            <?php } ?>
                        </div>
                        <h2><?php echo money("Rp.",$dt_product->SALE_PRICE); ?></h2>
                        <p><?php echo $dt_product->NAME; ?></p>
                        <a href="<?php echo $dirhost; ?>/zendfront/pages/cart/page.php?id_product=<?php echo $dt_product->ID_PRODUCT; ?>" class="btn btn-default add-to-cart" data-toggle="modal" data-target="#shoppingCartModal" data-remote="false"  data-title=""><i class="fa fa-shopping-cart"></i> Ke Troli</a>
                    </div>
                    <div class="product-overlay">
                        <div class="overlay-content">
                            <h2><?php echo money("Rp.",$dt_product->SALE_PRICE); ?></h2>
                            <p><?php echo $dt_product->NAME; ?></p>
                            <a href="<?php echo $dirhost; ?>/zendfront/pages/cart/page.php?id_product=<?php echo $dt_product->ID_PRODUCT; ?>" class="btn btn-default add-to-cart" data-toggle="modal" data-target="#shoppingCartModal" data-remote="false" data-title=""><i class="fa fa-shopping-cart"></i> Ke Troli</a>
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

<?php } ?>
    <div id="lastPostsLoader" style="clear:both"></div>
    <div  style="text-align:center" class="paging_box">
        <?php if($num_product > 10){?>
            <a href='javascript:void()' onclick="lastPostFunc()" class='next_button'>
                <i class='fa fa-angle-double-down'></i> Halaman Selanjutnya <i class='fa fa-angle-double-down'></i>
            </a>
        <?php } ?>
    </div>						
	<input type="hidden" id="data_page" value="<?php echo $dirhost; ?>/<?php echo $ajax_dir; ?>/data.php"/>
    <input type="hidden" id="id_kategori" value="<?php echo @$id_category; ?>"/>
</div>
