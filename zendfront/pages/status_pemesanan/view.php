<?php defined('mainload') or die('Restricted Access'); ?>
<div class="features_items""><!--features_items-->
    <h2 class="title text-center">Produk Terbaru</h2>

<?php while($dt_product = $db->fetchNextObject($q_product)){
	$photo 		= $db->fob("PHOTOS",$tpref."products_photos"," WHERE ID_PRODUCT = '".$dt_product->ID_PRODUCT."'");
?>
    <div class="col-sm-3">
        <div class="product-image-wrapper">
            <div class="single-products">
                    <div class="productinfo text-center">
						<?php if(!empty($photo) && is_file($basepath."/files/images/products/".$photo)){?>
                        <img src="<?php echo $dirhost; ?>/files/images/products/<?php echo $photo; ?>" class="img-responsive" alt=""/>
                        <?php }else{?>
                        <img src="<?php echo $dirhost; ?>/files/images/no_image.jpg" class="img-responsive" alt=""/>
                        <?php } ?>
                        <h2><?php echo money("Rp.",$dt_product->SALE_PRICE); ?></h2>
                        <p><?php echo $dt_product->NAME; ?></p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Ke Troli</a>
                    </div>
                    <div class="product-overlay">
                        <div class="overlay-content">
                            <h2><?php echo money("Rp.",$dt_product->SALE_PRICE); ?></h2>
                            <p><?php echo $dt_product->NAME; ?></p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Ke Troli</a>
                        </div>
                    </div>
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                </ul>
            </div>
        </div>
    </div>

<?php } ?>
</div>

						
<ul class="pagination">
    <li class="active"><a href="">1</a></li>
    <li><a href="">2</a></li>
    <li><a href="">3</a></li>
    <li><a href="">&raquo;</a></li>
</ul>
