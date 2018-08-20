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
    <link rel="alternate" href="<?php echo $dirhost; ?>" hreflang="id-id" />

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
    <!--<script src="<?php echo $web_ftpl_dir; ?>js/jquery-ui/jquery-ui.js"></script>
    <link href="<?php echo $web_ftpl_dir; ?>js/jquery-ui/jquery-ui.css" rel="stylesheet">-->
    
    <script src="<?php echo $dirhost; ?>/libraries/cookies/js.cookie.js"></script>
	<script src="<?php echo $dirhost; ?>/libraries/bootbox/bootbox.js"></script>
    
    <link href="<?php echo $web_ftpl_dir; ?>js/switch/css/bootstrap-toggle.min.css" rel="stylesheet">
	<script type="text/javascript" src="<?php echo $web_ftpl_dir; ?>js/switch/js/bootstrap-toggle.min.js"></script>
	<script type="text/javascript" src="<?php echo $web_ftpl_dir; ?>sidemenu/js/jquery.ntm.js"></script>
	<script type="text/javascript">
        $(document).ready(function() {
            $('.demo').ntm();
			
			/*var $elements = [$('#draggable'), $('#layer_3')];
			$("#draggable")
				.resizable({alsoResize: "#layer_3"})
				.draggable({
					containment: "parent",
					start: function (ev, ui) {
						var $elem
						for (var i in $elements) {
							$elem = $elements[i];
							if ($elem[0] != this) {
								$elem.data('dragStart', $elem.offset());
							}
						}
					},
					drag: function (ev, ui) {
						var $elem,
						deltaX = ui.position.left - ui.originalPosition.left;
						for (var i in $elements) {
							$elem = $elements[i];
							if ($elem[0] != this) {
								$elem.offset({
									top: $elem.data('dragStart').top,
									left: Math.max($elem.data('dragStart').left + deltaX, 8)
								});
							}
						}
					}
				});*/
        });
    </script>
    <?php if(is_file($basepath."/".$page_dir."/css/style.css")){ ?>
        <link rel="stylesheet" href="<?php echo $dirhost;?>/<?php echo $page_dir; ?>/css/style.css" type="text/css">
    <?php } ?>
    <script src="<?php echo $dirhost; ?>/includes/general.js"></script>
    <link rel="stylesheet" href="<?php echo $web_ftpl_dir; ?>sidemenu/css/theme.css" />
   
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-122957816-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'UA-122957816-1');
    </script>
    <style type="text/css">
		#draggable { 
			border	:1px solid #666;  
			width	: 93%; 
			height	: 75%; 
			padding	: 0.5em; 
			cursor	:move; 
			position:absolute;
			z-index	:10; 
			margin-top:13%;
			margin-left:4%;
		}
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
								<li><a href="#" title="<?php echo $website_name; ?>"><i class="fa fa-phone"></i> +62 812-8861-6068</a></li>
								<li><a href="#" title="Customer Service <?php echo $website_name; ?>"><i class="fa fa-envelope"></i> cs@itshijab.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="http://www.facebook.com/sharer.php?u=http://www.itshijab.com/" target="_blank" title="Facebook Custom Hijab Sendiri Itshijab"><i class="fa fa-facebook"></i></a></li>
								<li><a href="https://twitter.com/share?url=http://www.itshijab.com/&text=Beauty is act <?php echo $website_name; ?>" target="_blank" title="twitter Custom Hijab <?php echo $website_name; ?>" ><i class="fa fa-twitter"></i></a></li>
								<!--<li><a href="#"><i class="fa fa-instagram"></i></a></li>-->
								<li><a href="https://plus.google.com/share?url=http://www.itshijab.com" title="Google+ Custom Hijab Sendiri <?php echo $website_name; ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
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
							<a href="<?php echo $dirhost; ?>" class="fancybox fancybox.ajax" title="Desain Custom Hijab Sendiri Online">
                            	<img src="<?php echo $web_ftpl_dir; ?>images/home/logo.png" alt="" />
                            </a>
						</div>
					</div>
					<div class="col-sm-10">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
                            	<li><a href="<?php echo $dirhost; ?>" title="Desain Hijab Sendiri"><i class="fa fa-home"></i> Beranda</a></li>
								<li><a href="<?php echo $dirhost; ?>/kontak" title="Kontak Jasa Print Hijab Custom"><i class="fa fa-phone"></i> Kontak</a></li>
								<li><a href="<?php echo $dirhost; ?>/testimoni" title="Testimonial Konsumen Itshijab"><i class="fa fa-bullhorn"></i> Testimoni</a></li>
                               
								<li><a href="<?php echo $dirhost; ?>/konfirmasi" title="Konfirmasi Pembayaran"><i class="fa fa-bell"></i> Konfirmasi</a></li>		
                                <li><a href="<?php echo $dirhost; ?>/registration" title="Pendaftaran Member Komunitas Itshijab"><i class="fa fa-sign-in"></i> Pendaftaran</a></li>
                                <?php if(empty($_SESSION['uidkey'])){?>
                                <li><a href="<?php echo $dirhost; ?>/alibaba" title="Login"><i class="fa fa-lock"></i> Login</a></li>
								<?php }else{ ?>
                                <li><a href="<?php echo $dirhost; ?>?module=cpanel&page=home" title="Cpanel"><i class="fa fa-gear"></i> Cpanel</a></li>
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
				<div class=" col-sm-12">
					<?php include $call->inc($page_dir,"page.php"); ?>
                    <input type="hidden" id="config" value='"dirhost":"<?php echo $dirhost; ?>","position":"<?php echo $pos; ?>","page":"<?php echo $page; ?>"'/>
				</div>
			</div>
		</div>
	</section>
	
	<footer id="footer"><!--Footer-->		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2016 Itshijab Inc. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="http://sempoa.community" style="color:#800040; text-decoration:none;" title="Website Sosial Bisnis Digital">Sempoa Community</a></span></p>
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
