<?php defined('mainload') or die('Restricted Access'); ?>
	<script type="application/ld+json">
    {
      "@context": "http://schema.org/",
      "@type": "Product",
      "name": "<?php echo $dt_product->NAME; ?>",
      "image": [
				<?php if(!empty($photo) && is_file($basepath."/files/images/products/".$photo)){?>
				"<img src='<?php echo $dirhost; ?>/files/images/products/<?php echo $photo; ?>' class='img-responsive' alt='<?php echo $dt_product->NAME; ?>' title='<?php echo $dt_product->NAME; ?>'/>"
				<?php } ?>
       ],
      "description": "Sleeker than ACME's Classic Anvil, the Executive Anvil is perfect for the business traveler looking for something to drop from a height.",
      "mpn": "<?php echo $dt_product->CODE; ?>",
      "brand": {
        "@type": "Thing",
        "name": "Its-HIJAB"
      },
      "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "4.4",
        "reviewCount": "89"
      },
      "offers": {
        "@type": "Offer",
        "priceCurrency": "IDR",
        "price": "<?php echo $dt_product->SALE_PRICE; ?>",
        "itemCondition": "http://schema.org/NewCondition",
        "availability": "http://schema.org/InStock"
      }
    }
    </script>
    <div class="product-details"><!--product-details-->
        <div class="col-sm-5">
            <div class="view-product" itemprop="image" >
				<?php if(!empty($photo) && is_file($basepath."/files/images/products/".$photo)){?>
                	<img src="<?php echo $dirhost; ?>/files/images/products/<?php echo $photo; ?>"/>
                <?php }else{?>
                	<img src="<?php echo $dirhost; ?>/files/images/no_image.jpg" />
                <?php } ?>
                <h3>ZOOM</h3>
            </div>
            <div id="similar-product" class="carousel slide" data-ride="carousel">
                
                  <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                            <div class="item active" itemprop="image">
                        <?php 
							$a = 0;
							while($dt_product_sim = $db->fetchNextObject($q_product_sim)){ $a++;
							@$photo_sim 	= $db->fob("PHOTOS",$tpref."products_photos"," WHERE ID_PRODUCT = '".$dt_product_sim->ID_PRODUCT."'");
								if($a > 3){ $a = 1; ?>
							</div> 
							<div class="item">
						<?php 	} ?>
                              <div style="max-height:150px; overflow:hidden; float:left">
                                  <a href="<?php echo $dirhost; ?>/detail/<?php echo $dt_product_sim->ID_PRODUCT; ?>" title="<?php echo $dt_product_sim->NAME; ?>">
                                    <?php if(!empty($photo_sim) && is_file($basepath."/files/images/products/".$photo_sim)){?>
                                        <img src="<?php echo $dirhost; ?>/files/images/products/<?php echo $photo_sim; ?>" 
                                             style="width:80px" title="<?php echo $dt_product_sim->NAME; ?>"/>
                                    <?php }else{?>
                                        <img src="<?php echo $dirhost; ?>/files/images/no_image.jpg" 
                                             style="width:85px" title="<?php echo $dt_product_sim->NAME; ?>"/>
                    	<?php 	  		} ?>
                                  </a>
                              </div>
						<?php
                        	}
						?>
                            </div>
                    </div>

                  <!-- Controls -->
                  <a class="left item-control" href="#similar-product" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                  </a>
                  <a class="right item-control" href="#similar-product" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                  </a>
            </div>

        </div>
        <div class="col-sm-7">
            <div class="product-information"><!--/product-information-->
                <img src="<?php echo $web_ftpl_dir; ?>images/product-details/new.jpg" class="newarrival" alt="" itemprop="image"/>
                <h2><?php echo ucwords($dt_product->NAME); ?></h2>
                <p>Kode ITEM: <?php echo $dt_product->CODE; ?></p>
                    	<img src="<?php echo $web_ftpl_dir; ?>images/product-details/rating.png" alt="" />
                </span>
                 <br clear="all">
                <span >
                    <span><?php echo money("Rp.",$dt_product->SALE_PRICE); ?></span>
                    <br clear="all">
                    <label>Jumlah:</label>
                    <input type="text" value="3" />
                    <a href="<?php echo $dirhost; ?>/<?php echo $pos; ?>/pages/cart/page.php?id_product=<?php echo $dt_product->ID_PRODUCT; ?>" data-toggle="modal" data-target="#shoppingCartModal" data-remote="false"  data-title="">
                    <button type="button" class="btn btn-fefault cart add-to-cart">
                        <i class="fa fa-shopping-cart"></i>
                        Ke Troli
                    </button>
                   </a> 
                </span>
                <?php if(!empty($dt_product->DESCRIPTION)){?>
                <p><b>Deskripsi: </b>
                	<br />
					<?php echo $dt_product->DESCRIPTION; ?>
                </p>
                <?php } ?>
                <p><b>Ketersediaan:</b> In Stock</p>
                <p><b>Kondisi:</b> New</p>
                <p><b>Merk:</b> Its-HIJAB</p>
                <a href=""><img src="<?php echo $web_ftpl_dir; ?>images/product-details/share.png" class="share img-responsive"  alt="" /></a>
            </div><!--/product-information-->
        </div>
    </div><!--/product-details-->
        
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
			<?php } ?>
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <div style="height:180px; overflow:hidden">
									<?php if(!empty($photo) && is_file($basepath."/files/images/products/".$photo)){?>
                                        <img src="<?php echo $dirhost; ?>/files/images/products/<?php echo $photo; ?>" class="img-responsive" alt="<?php echo $dt_product_reco->NAME; ?>" title="<?php echo $dt_product_reco->NAME; ?>"/>
                                    <?php }else{?>
                                        <img src="<?php echo $dirhost; ?>/files/images/no_image.jpg" class="img-responsive"  alt="<?php echo $dt_product_reco->NAME; ?>" title="<?php echo $dt_product_reco->NAME; ?>"/>
                                    <?php } ?>
                                </div>
                                <h2><?php echo money("Rp.",$dt_product_reco->SALE_PRICE); ?></h2>
                                <p><?php echo $dt_product_reco->NAME; ?></p>
                                <a href="<?php echo $dirhost; ?>/<?php echo $pos; ?>/pages/cart/page.php?id_product=<?php echo $dt_product_reco->ID_PRODUCT; ?>" class="btn btn-default add-to-cart" data-toggle="modal" data-target="#shoppingCartModal" data-remote="false" data-title=""><i class="fa fa-shopping-cart"></i>Ke Troli</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
			<?php } ?>
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
