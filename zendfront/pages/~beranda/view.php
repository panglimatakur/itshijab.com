<?php defined('mainload') or die('Restricted Access'); ?>
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Produk Terbaru</h2>
<?php while($dt_product = $db->fetchNextObject($q_product)){
	$photo 		= $db->fob("PHOTOS",$tpref."products_photos"," WHERE ID_PRODUCT = '".$dt_product->ID_PRODUCT."'");
?>
    <div class="col-sm-3" id="product_<?php echo $dt_product->ID_PRODUCT; ?>">
        <div class="product-image-wrapper">
            <div class="single-products">
                    <div class="productinfo text-center">
						<div style="height:180px; overflow:hidden">
							<?php if(!empty($photo) && is_file($basepath."/files/images/products/".$photo)){?>
                            <img src="<?php echo $dirhost; ?>/files/images/products/<?php echo $photo; ?>" class="img-responsive" alt=""/>
                            <?php }else{?>
                            <img src="<?php echo $dirhost; ?>/files/images/no_image.jpg" class="img-responsive" alt=""/>
                            <?php } ?>
                        </div>
                        <div >
                        <h2 ><?php echo money("Rp.",$dt_product->SALE_PRICE); ?></h2>
                        <p><?php echo ucwords($dt_product->NAME); ?></p>
                        <a href="<?php echo $dirhost; ?>/<?php echo $pos; ?>/pages/cart/page.php?id_product=<?php echo $dt_product->ID_PRODUCT; ?>" class="btn btn-default add-to-cart" data-toggle="modal" data-target="#shoppingCartModal" data-remote="false"  data-title=""><i class="fa fa-shopping-cart"></i>Ke Troli</a>
                    </div>
                    <div class="product-overlay">
                        <div class="overlay-content">
                        	<meta itemprop="priceCurrency" content="IDR" />
                            <h2 ><?php echo money("Rp.",$dt_product->SALE_PRICE); ?></h2>
                            <p><?php echo ucwords($dt_product->NAME); ?></p>
                            <a href="<?php echo $dirhost; ?>/<?php echo $pos; ?>/pages/cart/page.php?id_product=<?php echo $dt_product->ID_PRODUCT; ?>" class="btn btn-default add-to-cart" data-toggle="modal" data-target="#shoppingCartModal" data-remote="false" data-title=""><i class="fa fa-shopping-cart"></i>Ke Troli</a>
                        </div>
                        </div >
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
</div>

<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">Produk Rekomendasi</h2>
    
    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
			<?php $a = 0; while($dt_product_reco = $db->fetchNextObject($q_product_reco)){ $a++;
                $photo 	= $db->fob("PHOTOS",$tpref."products_photos"," WHERE ID_PRODUCT = '".$dt_product_reco->ID_PRODUCT."'");
				if($a > 4){ $a = 1; ?>
			</div>
            <div class="item">	
				<?php }
            ?>
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <div style="height:180px; overflow:hidden">
									<?php if(!empty($photo) && is_file($basepath."/files/images/products/".$photo)){?>
                                        <img src="<?php echo $dirhost; ?>/files/images/products/<?php echo $photo; ?>" class="img-responsive" alt=""/>
                                    <?php }else{?>
                                        <img src="<?php echo $dirhost; ?>/files/images/no_image.jpg" class="img-responsive" alt=""/>
                                    <?php } ?>
                                </div>
                                <h2><?php echo money("Rp.",$dt_product_reco->SALE_PRICE); ?></h2>
                                <p><?php echo ucwords($dt_product_reco->NAME); ?></p>
                                <a href="<?php echo $dirhost; ?>/<?php echo $pos; ?>/pages/cart/page.php?id_product=<?php echo $dt_product_reco->ID_PRODUCT; ?>" class="btn btn-default add-to-cart" data-toggle="modal" data-target="#shoppingCartModal" data-remote="false" data-title=""><i class="fa fa-shopping-cart"></i>Ke Troli</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            <?php 
			} 
			?>
            </div>
        </div>
         <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
          </a>
          <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
          </a>			
    </div>
</div><!--/recommended_items-->
