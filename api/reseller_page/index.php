<?php
session_start();
//session_destroy();
include("itshijab_api.php");
$itshijab 	= new api;
?>
<link href="<?php echo $host_url; ?>/api/bootstrap/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo $host_url; ?>/zendfront/templates/eshopper/fonts/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo $host_url; ?>/api/reseller_page/style.css" rel="stylesheet">

<body>
	<header>
    	<div class="container">
                <div class="col-md-6 top-menu">
                    <ul class="nav navbar-nav">
                    	<li><a href="?page=kontak">Kontak</a></li>
                    	<li><a href="?page=testimonial">Testimonial</a></li>
                    	<li><a href="?page=item_cart_list">Daftar Pesanan</a></li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="http://www.facebook.com/sharer.php?u=http://www.itshijab.com/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://twitter.com/share?url=http://www.itshijab.com/&amp;text=Beauty is act itshijab" target="_blank"><i class="fa fa-twitter"></i></a></li>
                            <!--<li><a href="#"><i class="fa fa-instagram"></i></a></li>-->
                            <li><a href="https://plus.google.com/share?url=http://www.itshijab.com" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>            
                </div>
        </div>
    </header>
    <div class="container">
        <div class="col-md-3">
         <div class="text-center"><img src="logo.png" /></div>
         <h3 class="title text-center">Kategori Hijab</h3>
          <div class="list-group list-group-menu">
          	<div class="list-group-item"><a href="?page=item_list">Semua Kategori</a></div>
            <?php
            $result  = $itshijab->viewProductCategory();   
            foreach($result as &$data){?>
                <div class="list-group-item">
                    <a href="?page=item_list&id_category=<?php echo @$data['id_category']; ?>">
						<?php echo $data["nama"]; ?>
                    </a>
                </div>
            <?php } ?>
            </div>
        </div>
        
        <div class="col-md-9">
        	<h3 class="title">Daftar Hijab</h3>
        	<?php
				$page 		 = isset($_REQUEST['page']) 		? $_REQUEST['page']			:"";  
				$id_product  = isset($_REQUEST['id_product']) 	? $_REQUEST['id_product']	:"";  
				$id_category = isset($_REQUEST['id_category']) 	? $_REQUEST['id_category']	:"";  
				if(empty($page)){ $page = "item_list"; }
				include("pages/".$page."/view.php");
			?>
        </div>
    </div>
    <footer>
    
    </footer>
    
    <div id="modal-cart" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content animated flipInY">
                <div class="modal-header"> 
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title"><i class='fa fa-shopping-cart'></i> Troli Belanja</h4>
                </div>
                <div class="modal-body" style=""></div>
            </div>
        </div>
    </div>
    
</body>
<input type="text" id="config" value='"host_url":"<?php echo $host_url; ?>","api_url":"<?php echo $api_url; ?>"'>  
<?php curl_close($curl); ?>
<script src="<?php echo $host_url; ?>/api/js/jquery.js"></script>
<script src="<?php echo $host_url; ?>/api/bootstrap/bootstrap.min.js"></script>
<script src="<?php echo $host_url; ?>/libraries/bootbox/bootbox.js"></script>
<script src="<?php echo $host_url; ?>/libraries/cookies/js.cookie.js"></script>
<script language="javascript">
	//$(document).ready(function(){
		$(".order").on("click", function() {
			idp = $(this).attr("data-value");
			$("#modal-cart").modal("show");
			$.ajax({
				url 	: "pages/item_cart_list/view.php",
				type 	: "POST",
				data 	: {"idp":idp},
				success : function(response){
					$("#modal-cart .modal-body").html(response);
				}
			})
		});
	//})
</script>