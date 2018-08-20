<?php defined('mainload') or die('Restricted Access'); ?>


	<?php if(!empty($id_blog)){?>
        <div class="blog-post-area">
            <h2 class="title text-center">Blog Terbaru <?php echo $category; ?></h2>        
        
                    <div class="single-blog-post" style="border-bottom: 1px solid #f5f5f5;">
                        <h3><a href="<?php echo $dirhost; ?>/blog/<?php echo $dt_halaman->PAGE; ?>/<?php echo $dt_halaman->ID_POST; ?>"><?php echo $dt_halaman->TITLE; ?></a></h3>
                        <div class="post-meta">
                            <ul>
                                <li>
                                	<i class="fa fa-calendar"></i> 
									<?php echo $dtime->now2indodate2($dt_halaman->TGLUPDATE); ?>
                                </li>
                            </ul>
                        </div>
                        <p>
                           <?php if(!empty($dt_halaman->ICON) && is_file($basepath."/files/images/".$dt_halaman->ICON)){?>
                           	<div class="pull-left thumbnail" style="margin-right:5px;width: 120px;">			
                            	<div style="height:110px; overflow:hidden">
                            <img src="<?php echo $dirhost; ?>/files/images/<?php echo $dt_halaman->ICON; ?>" alt="<?php echo $dt_halaman->TITLE; ?>" title="<?php echo $dt_halaman->TITLE; ?>" width="100%"/>
                            	</div>
                            </div>
							<?php } ?>
                        	<div  style="text-align:justify"><?php echo $dt_halaman->CONTENT; ?></div>
                            <br />
                       </p>  
                    </div>
	</div>
    <?php } ?>

	<?php if(!empty($id_category) || empty($id_blog)){?>
                <div class="blog-post-area">
                    <h2 class="title text-center">Blog Terbaru <?php echo $category; ?></h2>
                    
					<?php while($dt_halaman		= $db->fetchNextObject($q_halaman)){?>
                    <div class="single-blog-post" style="border-bottom: 1px solid #f5f5f5;">
                        <h3><a href="<?php echo $dirhost; ?>/blog/<?php echo $dt_halaman->PAGE; ?>/<?php echo $dt_halaman->ID_POST; ?>"><?php echo $dt_halaman->TITLE; ?></a></h3>
                        <div class="post-meta">
                            <ul>
                                <li>
                                	<i class="fa fa-calendar"></i> 
									<?php echo $dtime->now2indodate2($dt_halaman->TGLUPDATE); ?>
                                </li>
                            </ul>
                        </div>
                        <p>
                           <?php if(!empty($dt_halaman->ICON) && is_file($basepath."/files/images/".$dt_halaman->ICON)){?>
                           	<div class="pull-left thumbnail" style="margin-right:5px;width: 120px;">			
                            	<div style="height:110px; overflow:hidden">
                            <img src="<?php echo $dirhost; ?>/files/images/<?php echo $dt_halaman->ICON; ?>" alt="<?php echo $dt_halaman->TITLE; ?>" title="<?php echo $dt_halaman->TITLE; ?>" width="100%"/>
                            	</div>
                            </div>
							<?php } ?>
                        	<div  style="text-align:justify"><?php echo printtext($dt_halaman->CONTENT,500); ?></div>
                            <br />
                           <a  class="btn btn-primary" href="<?php echo $dirhost; ?>/blog/<?php echo $dt_halaman->PAGE; ?>/<?php echo $dt_halaman->ID_POST; ?>">Read More</a>                          
                       </p>  
                    </div>
                    <?php } ?>
                    
                </div>    
    <?php }?>
    
