<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="">
		<?php
        if(!empty($page) && $page != "detail"){
            if($page == "statis"){ $page = $_REQUEST['parameters']; }
            $q_tags 		= $db->query("SELECT * FROM system_pages_client WHERE PAGE = '".$page."'");
            $dt_tag			= $db->fetchNextObject($q_tags);
            @$title			= $dt_tag->TITLE;
            @$description	= $dt_tag->DESCRIPTION;
            @$keywords		= $dt_tag->KEYWORDS;
        }else{
			if(!empty($parameters)){
				$par 		 = explode("/",$parameters);
				$id_product  = $par[0];
			}
			if(!empty($id_product)){
				$condition 		.= " AND ID_PRODUCT = '".$id_product."'";  
			}
			$q_str_product_meta 		= "SELECT * FROM ".$tpref."products WHERE ID_PRODUCT IS NOT NULL ".$condition." ORDER BY ID_PRODUCT DESC";
			$q_product_meta 	= $db->query($q_str_product_meta);
			$dt_product_meta 	= $db->fetchNextObject($q_product_meta);
            @$title				= ucwords($dt_product_meta->NAME);
            @$description		= $dt_product_meta->DESCRIPTION;
            @$keywords			= $dt_product_meta->NAME.", pashmina, segiempat, murah, hijab, premium, bandung";
		}
		
        ?>
    <title><?php echo @$title; ?></title>
    <meta name="keywords" content="<?php echo @$keywords; ?>"/>
    <meta name="description" content="<?php echo @$description; ?>"/>
    <meta property="og:title" content="<?php echo @$title; ?>"/>
    <meta property="og:image" content="<?php echo $dirhost; ?>/files/images/logo.png"/> 
    <meta property="og:type" content="website" /> 
    <meta property="og:site_name" content="<?php echo @$website_name; ?>"/>
    <meta property="og:description" content="<?php echo @$description; ?>"/>
    <meta name="robots" content="INDEX, FOLLOW">
    <meta property="og:url" content="<?php echo $dirhost; ?>" />
    <link rel="alternate" href="<?php echo $dirhost; ?>" hreflang="ID-MY" />

    <link href="<?php echo $web_ftpl_dir; ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $web_ftpl_dir; ?>fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo $web_ftpl_dir; ?>css/prettyPhoto.css" rel="stylesheet">
    <!--<link href="<?php echo $web_ftpl_dir; ?>css/price-range.css" rel="stylesheet">-->
    <link href="<?php echo $web_ftpl_dir; ?>css/animate.css" rel="stylesheet">
	<link href="<?php echo $web_ftpl_dir; ?>css/main.css" rel="stylesheet">
	<link href="<?php echo $web_ftpl_dir; ?>css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="<?php echo $web_ftpl_dir; ?>images/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $web_ftpl_dir; ?>images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $web_ftpl_dir; ?>images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $web_ftpl_dir; ?>images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo $web_ftpl_dir; ?>images/ico/apple-touch-icon-57-precomposed.png">
    <script src="<?php echo $web_ftpl_dir; ?>js/jquery.js"></script>
    <script src="<?php echo $dirhost; ?>/libraries/cookies/js.cookie.js"></script>
	<script src="<?php echo $dirhost; ?>/libraries/bootbox/bootbox.js"></script>
    
    <link href="<?php echo $web_ftpl_dir; ?>js/switch/css/bootstrap-toggle.min.css" rel="stylesheet">
	<script type="text/javascript" src="<?php echo $web_ftpl_dir; ?>js/switch/js/bootstrap-toggle.min.js"></script>
	<script type="text/javascript" src="<?php echo $web_ftpl_dir; ?>sidemenu/js/jquery.ntm.js"></script>
	<script type="text/javascript">
        $(document).ready(function() {
            $('.demo').ntm();
			
        });
		
    </script>
    <?php if(is_file($basepath."/".$page_dir."/css/style.css")){ ?>
        <link rel="stylesheet" href="<?php echo $dirhost;?>/<?php echo $page_dir; ?>/css/style.css" type="text/css">
    <?php } ?>
    <script src="<?php echo $dirhost; ?>/includes/general.js"></script>
    <link rel="stylesheet" href="<?php echo $web_ftpl_dir; ?>sidemenu/css/theme.css" />
    <style type="text/css">
		.capitalize{ text-transform:capitalize; }
		.uppercase{ text-transform:uppercase; }
		.lowercase{ text-transform:lowercase; }
		.req:after { content: " *"; color: #ff0000; }
		.footer_btn{
			position:fixed; 
			width:93%; 
			padding:5px 5px 5px 7px; 
			margin-bottom:3px; 
			bottom:0; 
			background:#FFF;	
		}
		.cancel-cart{
			margin:0 6px 0 0; 
			background:none; 
			border:none; 
			padding:0 0 0 15px
		}
	</style>
    <?php 
		$activity = "Seseorang melihat halaman ".@$page." ".@$parameter[0]." melalui <a href='".$dirhost."/?module=cpanel&page=home&condition=OS&value=".@$user_os."'>".$user_os."</a>";
		visitor_log($activity); 
	?>
</head><!--/head-->

<!--<body>-->
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +62 812-8861-6068</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> cs@itshijab.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="http://www.facebook.com/sharer.php?u=http://www.itshijab.com/" target="_blank"><i class="fa fa-facebook"></i></a></li>
								<li><a href="https://twitter.com/share?url=http://www.itshijab.com/&text=Beauty is act itshijab" target="_blank"><i class="fa fa-twitter"></i></a></li>
								<!--<li><a href="#"><i class="fa fa-instagram"></i></a></li>-->
								<li><a href="https://plus.google.com/share?url=http://www.itshijab.com" target="_blank"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="logo pull-left">
							<a href="<?php echo $dirhost; ?>" class="fancybox fancybox.ajax">
                            	<img src="<?php echo $web_ftpl_dir; ?>images/home/logo.png" alt="" />
                            </a>
						</div>
					</div>
					<div class="col-sm-10">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
                            	<li><a href="<?php echo $dirhost; ?>"><i class="fa fa-home"></i> Beranda</a></li>
								<li><a href="<?php echo $dirhost; ?>/kontak"><i class="fa fa-phone"></i> Kontak</a></li>
								<li><a href="<?php echo $dirhost; ?>/testimoni"><i class="fa fa-bullhorn"></i> Testimoni</a></li>
                                <li><a href="<?php echo $dirhost; ?>/category"><i class="fa fa-gift"></i> Katalog</a></li>
                                <li><a href="<?php echo $dirhost; ?>/<?php echo $pos; ?>/pages/cart/page.php" data-toggle="modal" data-target="#cartModal" data-remote="false"  data-title="Keranjang Belanja"><i class="fa fa-shopping-cart"></i> Cart</a></li>
								<li><a href="<?php echo $dirhost; ?>/konfirmasi"><i class="fa fa-bell"></i> Konfirmasi</a></li>		
                                <li><a href="<?php echo $dirhost; ?>/registration"><i class="fa fa-sign-in"></i> Pendaftaran</a></li>
                                <?php if(empty($_SESSION['uidkey'])){?>
                                <li><a href="<?php echo $dirhost; ?>/alibaba"><i class="fa fa-lock"></i> Login</a></li>
								<?php }else{ ?>
                                <li><a href="<?php echo $dirhost; ?>?module=cpanel&page=home"><i class="fa fa-gear"></i> Cpanel</a></li>
                                <?php } ?>
                            </ul>
                            <div class="clearfix"></div>
                            <div class="search_box pull-right" style="margin-top:15px">
                                <input type="text" placeholder="Search" style="width:100%"/>
                            </div>
						</div>

					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	</header><!--/header-->
	
	<section>
		<div class="container" <?php if(!empty($page)){?> style="padding-top:20px;" <?php } ?>>
			<div class="row">
				<?php 
					$fullpage = array(1=>"kontak","about","eksperimen","beranda"); 
					$ch_page  = array_search($page,$fullpage);
					if(empty($ch_page)){
				?>
                <div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Kategori</h2>
                        
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
						<?php 
                        function cpanel_sidebar($id_parent){
                            global $dirhost;
                            global $db;
                            global $page;
							global $tpref;
                            $q_cmenu 	= $db->query("SELECT ID_PRODUCT_CATEGORY,NAME,PAGE,DESCRIPTION FROM ".$tpref."products_categories WHERE ID_PARENT = '".$id_parent."' AND STATUS = '1' ORDER BY SERI ASC");
                            $num_cmenu = $db->numRows($q_cmenu);
                            if($num_cmenu > 0){ 
                        ?>
                            <ul>
                            
                        <?php
                                while($dt_cmenu = $db->fetchNextObject($q_cmenu)){
								  
									  //if(is_mod_rewrite_enabled()) {
										$link_page = "category/".$dt_cmenu->ID_PRODUCT_CATEGORY."/".$dt_cmenu->PAGE;
									 // }else{
										//$link_page = "?page=category&id_category=".$dt_cmenu->ID_PRODUCT_CATEGORY."&category=".$dt_cmenu->PAGE; 
									 // }
								$sum_cmenu 	= $db->recount("SELECT ID_PRODUCT_CATEGORY FROM  ".$tpref."products_categories WHERE ID_PARENT = '".$dt_cmenu->ID_PRODUCT_CATEGORY."' ORDER BY SERI ASC");
									  if($sum_cmenu == 0){
										$link_url = $dirhost."/".$link_page;  
									  }else{
										$link_url = "javascript:void()";  
									  }
                                  
                                ?>
                                   <li>
                                        <a href="<?php echo $link_url; ?>" >
                                            <?php echo $dt_cmenu->NAME; ?>
                                        </a>
                                        <?php echo cpanel_sidebar($dt_cmenu->ID_PRODUCT_CATEGORY); ?>
                                   </li>
                        <?php 		} ?>
                            </ul>
                            
                        <?php 
                                }
                        }
                        ?>
                          <div class="tree-menu demo" id="tree-menu">
                            <ul>
								<?php 
                                    $q_cmenu = $db->query("SELECT ID_PRODUCT_CATEGORY,NAME,PAGE,DESCRIPTION FROM ".$tpref."products_categories WHERE ID_PARENT = '0' AND STATUS = '1' ORDER BY SERI ASC");
                                    while($dt_cmenu = $db->fetchNextObject($q_cmenu)){
                                      $sum_cmenu = "";
										  
									  //if(is_mod_rewrite_enabled()) {
										$link_page = "category/".$dt_cmenu->ID_PRODUCT_CATEGORY."/".$dt_cmenu->PAGE;
									  //}else{
										//$link_page = "?page=category&id_category=".$dt_cmenu->ID_PRODUCT_CATEGORY."&category=".$dt_cmenu->PAGE; 
									  //}
								$sum_cmenu 	= $db->recount("SELECT ID_PRODUCT_CATEGORY FROM  ".$tpref."products_categories WHERE ID_PARENT = '".$dt_cmenu->ID_PRODUCT_CATEGORY."' ORDER BY SERI ASC");
									  if($sum_cmenu == 0){
										$link_url = $dirhost."/".$link_page;  
									  }else{
										$link_url = "javascript:void()";  
									  }
                                ?>
                                <li>
                                	<a href="<?php echo $link_url; ?>"><?php echo $dt_cmenu->NAME; ?></a>
                                	<?php echo cpanel_sidebar($dt_cmenu->ID_PRODUCT_CATEGORY); ?>
                                </li>
                              <?php } ?>
                              
                            </ul>
                          </div>
                          
						</div><!--/category-products-->
										
					</div>
				</div>
                <?php } ?>
				
				<div class=" <?php if(empty($ch_page)){?>col-sm-9 padding-right<?php }else{?> col-sm-12 <?php } ?>">
					<?php include $call->inc($page_dir,"page.php"); ?>
                    <input type="hidden" id="config" value='"dirhost":"<?php echo $dirhost; ?>","position":"<?php echo $pos; ?>","page":"<?php echo $page; ?>"'/>
				</div>
			</div>
		</div>
	</section>
	
	<footer id="footer"><!--Footer-->
		<!--<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>Its</span>-hijab</h2>
							<p>Menjual berbagai macam hijab unik dari berbagai macam motif dan bahan</p>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="<?php echo $web_ftpl_dir; ?>images/home/iframe1.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="<?php echo $web_ftpl_dir; ?>images/home/iframe2.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="<?php echo $web_ftpl_dir; ?>images/home/iframe3.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="<?php echo $web_ftpl_dir; ?>images/home/iframe4.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="address">
							<img src="<?php echo $web_ftpl_dir; ?>images/home/map.png" alt="" />
							<p>Jl.Bojong Koneng No.45 Bandung - Jawa Barat</p>
						</div>
					</div>
				</div>
			</div>
		</div>-->
		
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Layanan</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="<?php echo $dirhost; ?>/blog">Blog</a></li>
                                <li><a href="<?php echo $dirhost; ?>/kontak">Kontak Kami</a></li>
								<li><a href="<?php echo $dirhost; ?>/statis/syarat_penggunaan">Syarat Penggunaan</a></li>
                                <li><a href="<?php echo $dirhost; ?>/registration">Pendaftaran</a></li>
								<li><a href="<?php echo $dirhost; ?>/statis/faq">FAQ’s</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Belanja</h2>
							<ul class="nav nav-pills nav-stacked">
                                <li><a href="<?php echo $dirhost; ?>/konfirmasi">Konfirmasi Pembayaran</a></li>
                                <li><a href="<?php echo $dirhost; ?>/statis/cara_belanja">Cara Belanja</a></li>
								<li><a href="<?php echo $dirhost; ?>/status_pemesanan">Status Pemesanan</a></li>
								<li><a href="<?php echo $dirhost; ?>/statis/syarat_refund">Syarat Refund</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="single-widget">
							<h2>Reseller</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="<?php echo $dirhost; ?>/reseller">Program Afiliasi / Reseller</a></li>
                                <li><a href="<?php echo $dirhost; ?>/api_reseller">API Reseller</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>Berlangganan Katalog</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Your email address" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Get the most recent updates from <br />our site and be updated your self...</p>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2016 Itshijab Inc. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="#">Sempoa Tech</a></span></p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
    <!-- Default bootstrap modal example -->
    <div class="modal fade modal-bg" id="shoppingCartModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"> 
                    
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="ajaxModalLabel"><i class='fa fa-shopping-cart'></i> Troli Belanja</h4>
                </div>
                <div class="modal-body" style="max-height:400px; overflow:scroll">
                </div>
            </div>
        </div>
    </div>
    
    
	<script src="<?php echo $web_ftpl_dir; ?>js/bootstrap.min.js"></script>
	<script src="<?php echo $web_ftpl_dir; ?>js/jquery.scrollUp.min.js"></script>
	<script src="<?php echo $web_ftpl_dir; ?>js/jquery.blockUI.js"></script>
    <script src="<?php echo $web_ftpl_dir; ?>js/slimscroll/jquery.slimscroll.js"></script>
    <script src="<?php echo $web_ftpl_dir; ?>js/jquery.prettyPhoto.js"></script>
    <script src="<?php echo $web_ftpl_dir; ?>js/popper.min.js"></script>
    <script src="<?php echo $web_ftpl_dir; ?>js/main.js"></script>
    <?php if(is_file($basepath."/".$page_dir."/js/js.js")){ ?>
        <script language="javascript" src="<?php echo $dirhost; ?>/<?php echo $page_dir; ?>/js/js.js"></script>
    <?php } ?>
    
    <script language="javascript">
	$("#shoppingCartModal").on("show.bs.modal", function(e) {
		var link 		= $(e.relatedTarget);
		var title 		= link.attr("data-title");
		$(this).find(".modal-body").load(link.attr("href"));
		//$("#ajaxModalLabel").html(title);
	});
	$('[data-toggle="popover"]').popover()
	</script>
<!--</body>-->
</html>
