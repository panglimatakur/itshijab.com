<?php
session_start();
//unset($_SESSION["order_id_product"]);
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

	if(!defined('mainload')) { define('mainload','ITSHIJAB',true); }
	include_once("../../../includes/config.php");
	include_once("../../../includes/classes.php");
	include_once("../../../includes/functions.php");
	include_once("../../../includes/declarations.php");
	$direction 			= isset($_REQUEST['direction']) 	? $_REQUEST['direction'] 		: "";
	$id_product 	 	= isset($_REQUEST['id_product']) 	? $_REQUEST['id_product'] 	: "";

	if(@!in_array(@$id_product,@$_SESSION["order_id_product"])){
		@$_SESSION["order_id_product"][] = trim($id_product);
		set_array_cookie("order_id_product",$_SESSION["order_id_product"]);
	}
	@$order_id_product 	= get_array_cookie("order_id_product");	
	//print_r($_COOKIE['jumlah_order']);
?>
	<script language="javascript" src="<?php echo $dirhost; ?>/<?php echo $pos; ?>/pages/cart/js/js.js"></script>
	<?php include $call->lib("accounting"); ?>
    <section id="cart_items">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
<?php				$ttl_all 		= 0;
					$quantity_all	= 0;
					foreach(array_reverse($_SESSION['order_id_product']) as &$order_id_product){
					$jumlah_order[$order_id_product]   = 1;
					
					if(!empty($_COOKIE['jumlah_order'][$order_id_product])){ 
						$jumlah_order[$order_id_product] = $_COOKIE['jumlah_order'][$order_id_product];
					}
					
					$str_product 	= " SELECT 
											a.CODE,a.NAME,a.SALE_PRICE,a.DISCOUNT,b.PHOTOS 
										FROM 
											".$tpref."products a,
											".$tpref."products_photos b
										WHERE 
											a.ID_PRODUCT = b.ID_PRODUCT AND
											a.ID_PRODUCT = '".$order_id_product."'
										ORDER BY b.PHOTOS ASC";
					//echo $str_product;
					$q_product	  	= $db->query($str_product);
					$dt_product	 	= $db->fetchNextObject($q_product);
					$nm_product	 	= $dt_product->NAME;
					$pr_price	   	= $dt_product->SALE_PRICE;
					$discount 		= $dt_product->DISCOUNT;
					if(!empty($discount)){
						$disc_price	= ($pr_price/100)*$discount;
						$pr_price	= $pr_price-$disc_price;
					}
					$ttl_price[$order_id_product]  	= $pr_price*$jumlah_order[$order_id_product];
					if(!empty($_COOKIE['ttl_price'][$order_id_product])){ 
						$ttl_price[$order_id_product] = $_COOKIE['ttl_price'][$order_id_product];
					}
?>                   
                    
                        <tr id="tr_<?php echo @$order_id_product; ?>">
                            <td class="cart_product" >
                            	<input type="hidden" class="list_id" value="<?php echo $order_id_product; ?>"/>
                            	<div class="col-md-11">
                                	<h2 class="title" style="margin:0; padding-bottom:6px">
                                    	<b><?php //echo @$order_id_product; ?><?php echo @$dt_product->NAME; ?></b>
                                    </h2>
                                </div>
                                <div class="col-md-1">
                                	<button type="button" value="<?php echo $order_id_product; ?>" class="btn cancel-cart" id="cancel-cart_<?php echo $order_id_product; ?>" title="Batalkan"><i class="fa fa-close"></i></button>
                                    <span id="del_loader_<?php echo $order_id_product; ?>"></span>
                                </div>
                                <div class="col-md-3">
                                    <div class="thumbnail">
                                        <div style="max-height:150px; overflow:hidden">
                                    <?php if(is_file($basepath."/files/images/products/".$dt_product->PHOTOS)){?>
                                        <img src="<?php echo $dirhost; ?>/files/images/products/thumbnails/<?php echo $dt_product->PHOTOS; ?>" style="width:100%;" >
                                    <?php }else{ ?>
                                        <img src="<?php echo $dirhost; ?>/files/images/no_image.jpg" style="width:100%;">
                                    <?php } ?>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group col-md-6">
                                        <label>Kode Item</label><br />
                                        <input type="text" readonly class="form-control code-item" id="code_<?php echo $order_id_product; ?>" value="<?php echo @$dt_product->CODE; ?>" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Harga</label>
                                        <input type="text" readonly class="form-control" value="<?php echo money("Rp.",@$dt_product->SALE_PRICE); ?>" />
                                        <input type="hidden" id="price_<?php echo $order_id_product; ?>" value="<?php echo @$dt_product->SALE_PRICE; ?>" />
                                    </div>
                                    <div class="cart_quantity_button form-group col-md-6">
                                        <label>Jumlah</label>
                                        <div  style="background:#F0F0E9; clear:both; padding:2px 0 2px 0">
                                        <a class="cart_quantity_up" href="javascript:void()" data-title="<?php echo $order_id_product; ?>"> <i class="fa fa-plus"></i> </a>
                                        <input class="form-control col-md-4 cart_quantity_input" type="text" name="quantity" id="quantity_<?php echo $order_id_product; ?>" readonly value="<?php echo @$jumlah_order[$order_id_product]; ?>" autocomplete="off" size="10" style="width:33%; border-radius:0; -moz-border-radius:0; -webkit-border-radius:0">
                                        <a class="cart_quantity_down" href="javascript:void()" data-title="<?php echo $order_id_product; ?>"><i class="fa fa-minus"></i> </a>
                                        <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Subtotal</label>
                                        <input type="text" readonly  class="form-control" id="cart_total_price_<?php echo $order_id_product; ?>" value="<?php echo money("Rp.",@$ttl_price[$order_id_product]); ?>" />
                                        <input type="hidden" class="total_price" id="total_price_<?php echo $order_id_product; ?>" value="<?php echo @$ttl_price[$order_id_product]; ?>" />
                                    </div>
                                	
                                </div>
                            </td>
                        </tr>
<?php
					$ttl_all 		= $ttl_price[$order_id_product] 	+ $ttl_all;
					$quantity_all 	= $jumlah_order[$order_id_product] 	+ $quantity_all;
					}
?>	
                    </tbody>
                </table>
        </div>
    </section>
	<?php echo billing_support(); ?>
    <div class="purchasing_btn footer_btn">
        <div class="pull-left" style="padding-top:5px">
            <span>
                <b>Total :  
                    <span style="font-size:17px" id="total_belanja">
                        <?php echo money("Rp.",@$ttl_all); ?> 
                    </span> 
                    <input type="hidden" id="current_total" value="<?php echo @$ttl_all; ?>" />
                    (<span id="jumlah_belanja"><?php echo @$quantity_all; ?></span> ITEM)
                </b>
            </span>
        </div>
        <div class="pull-right">
            <button type="submit" class="btn btn-primary purchase-cart" style="margin-top:0"><i class="fa fa-calculator"></i> Konfirmasi Pesanan</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal" style="margin-top:0">
                <i class="fa fa-shopping-cart"></i> Lanjut Belanja
            </button>
        </div>
    </div>
    
<?php	
}
?>