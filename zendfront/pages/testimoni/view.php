<?php defined('mainload') or die('Restricted Access'); ?>
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Testimonial</h2>

<?php while($dt_testimoni = $db->fetchNextObject($q_testimoni)){
	$photo 		= $dt_testimoni->PHOTO;
?>
    <div class="col-sm-3">
        <div class="product-image-wrapper">
            <div class="single-products">
                    <div class="productinfo text-center">
						<?php if(!empty($photo) && is_file($basepath."/files/images/testimonials/".$photo)){?>
                        <a href="<?php echo $dirhost; ?>/files/images/testimonials/<?php echo $photo; ?>" class="fancybox">
                        	<img src="<?php echo $dirhost; ?>/files/images/testimonials/<?php echo $photo; ?>" class="img-responsive" alt=""/>
                        </a>
                        <?php }else{?>
                        <img src="<?php echo $dirhost; ?>/files/images/no_image.jpg" class="img-responsive" alt=""/>
                        <?php } ?>
                    </div>
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
