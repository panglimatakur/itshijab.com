<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	define('mainload','ITSHIJAB',true);
	include_once("../../../../includes/config.php");
	include_once("../../../../includes/classes.php");
	
	$direction 	= isset($_REQUEST['direction']) 	? $sanitize->str($_REQUEST['direction']) 	: "";
	$id_blog 	= isset($_REQUEST['id_blog']) 		? $sanitize->number($_REQUEST['id_blog']) 		: "";

	if(!empty($direction) && $direction == "preview"){ 
		$q_blog 		= $db->query("SELECT * FROM ".$tpref."posts WHERE ID_POST='".$id_blog."'");
		$dt_blog 		= $db->fetchNextObject($q_blog);
		$update_time 	= explode("-",$dt_blog->TGLUPDATE);
		$tgl 			= $update_time[2];
		$bln 			= $update_time[1];
		$thn			= $update_time[0];
		
		$q_contributor 	= $db->query("SELECT USER_REALNAME,USER_PHOTO from system_users_client WHERE ID_USER = '".$dt_blog->ID_USER."'");
		$dt_contributor = $db->fetchNextObject($q_contributor);
		@$contributor 	= $dt_contributor->USER_REALNAME;
		@$photo			= $dt_contributor->USER_PHOTO;
		$category 	= $db->fob("NAME",$tpref."posts_categories_master"," WHERE ID_POST_CATEGORY = '".$dt_blog->ID_POST_CATEGORY."'");
	?>
    <div class="row" style="width:800px">
    
<div class="col-md-12 blog-single">
			<div class="bs-meta">
				<span class="bs-cat"><?php echo @$category; ?></span>
				<span class="bs-comments"><a href="#"><i class="fa fa-comments-o"></i> 4 Comments</a> <em></em> <a href="#"><i class="fa fa-heart-o"></i> 23 Likes</a></span>
			</div>
			<h4><a href="#"><?php echo $dt_blog->TITLE; ?></a></h4>
			<div class="row">
				<div class="col-md-3 bs-aside">
					<?php if(is_file($basepath."/files/images/users/".$photo)){?>
                    	<img src="<?php echo $dirhost; ?>/files/images/users/<?php echo $photo; ?>" alt="" width="90%">
                    <?php }else{ ?>
                        <img src="<?php echo $dirhost; ?>/files/images/user.png" alt="" width="90%">
                    <?php } ?>
					<h6><?php echo @$contributor; ?></h6>
					<div class="sep1"></div>
					<div class="space10"></div>
					<div class="rp-date">
						<span><?php echo $dtime->nama_bulan($bln); ?></span>
                        <?php echo $tgl; ?>
						<span><em>/</em> <?php echo $thn; ?></span>
					</div>
					<div class="space30"></div>
					<div class="sep1"></div>
					<div class="space20"></div>
					<!--<em class="share-count">10K SHARE</em>-->
					<span class="bsa-social">
					<a href="#"><i class="fa fa-facebook"></i></a>
					<a href="#"><i class="fa fa-twitter"></i></a>
					<a href="#"><i class="fa fa-plus"></i></a>
					</span>
				</div>
				<div class="col-md-9">
                	<?php echo $dt_blog->CONTENT; ?>
                </div>
			</div>
		</div>    
    
    </div>
	<?php
	}
}
else{  defined('mainload') or die('Restricted Access'); }
?>
