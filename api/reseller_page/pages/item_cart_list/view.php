<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	session_start();
	$id_products 	 	= isset($_REQUEST['id_products']) 	? $_REQUEST['id_products'] 	: "";
	$quantities 	 	= isset($_REQUEST['quantities']) 	? $_REQUEST['quantities'] 	: "";
}
?>
	<script src="pages/item_cart_list/js.js"></script>
    <?php 	
	if(empty($login_page)){
		include("../../itshijab_api.php");
		$itshijab 	= new api;
		$idp 		= isset($_REQUEST['idp']) 	? $_REQUEST['idp'] 	: "";
		if(@!in_array(@$idp,@$_SESSION["order_id_product"])){
			@$_SESSION["order_id_product"][] = trim($idp);
		}
	?>
    <section id="cart_items">
        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
<?php				
                $ttl_all 		= 0;
                $quantity_all	= 0;
                foreach(array_reverse($_SESSION['order_id_product']) as &$order_id_product){
                    $datas		= array("id_product"=>$order_id_product);
                    $results  	= $itshijab->viewProduct($datas); 
                    
                    if(count($results) > 0){ //print_r($results[1]);
                    $nm_product	 	= $results[1]['nama'];
                    $pr_price	   	= $results[1]['harga'];
                    
                    $jumlah_order[$order_id_product]   	= 7;
                    if(!empty($_COOKIE['jumlah_order'][$order_id_product])){ 
                        $jumlah_order[$order_id_product] = $_COOKIE['jumlah_order'][$order_id_product];
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
                                    <b><?php echo ucwords($nm_product); ?></b>
                                </h2>
                            </div>
                            <div class="col-md-1">
                                <button type="button" value="<?php echo $order_id_product; ?>" class="btn cancel-cart" id="cancel-cart_<?php echo $order_id_product; ?>" title="Batalkan"><i class="fa fa-close"></i></button>
                                <span id="del_loader_<?php echo $order_id_product; ?>"></span>
                            </div>
                            <div class="col-md-3">
                                <div class="thumbnail">
                                    <div style="max-height:150px; overflow:hidden">
                                        <img src="<?php echo $results[1]['photo']; ?>" style="width:100%"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group col-md-6">
                                    <label>Kode Item</label><br />
                                    <input type="text" readonly class="form-control code-item" id="code_<?php echo $order_id_product; ?>" value="<?php echo $results[1]["code"]; ?>" />
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Harga</label>
                                    <input type="text" readonly class="form-control" value="<?php echo $itshijab->money("Rp.",@$results[1]["harga"]); ?>" />
                                    <input type="hidden" id="price_<?php echo $order_id_product; ?>" value="<?php echo @$results[1]["harga"]; ?>" />
                                </div>
                                <div class="cart_quantity_button form-group col-md-6">
                                    <label>Jumlah</label> 
                                    <div class="input-group cart_quantity_button">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-danger btn-lg" data-title="<?php echo $order_id_product; ?>"><i class="fa fa-plus"></i></button>
                                        </span>
                                        <input class="form-control col-md-4 cart_quantity_input cart_quantity_up" type="text" name="quantity" id="quantity_<?php echo $order_id_product; ?>" readonly value="<?php echo @$jumlah_order[$order_id_product]; ?>" autocomplete="off" size="10" style="height: 33px; border-radius:0; -moz-border-radius:0; -webkit-border-radius:0">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-danger btn-lg cart_quantity_down" data-title="<?php echo $order_id_product; ?>"><i class="fa fa-minus"></i></button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Subtotal</label>
                                    <input type="text" readonly  class="form-control" id="cart_total_price_<?php echo $order_id_product; ?>" value="<?php echo $itshijab->money("Rp.",@$ttl_price[$order_id_product]); ?>" />
                                    <input type="hidden" class="total_price" id="total_price_<?php echo $order_id_product; ?>" value="<?php echo @$ttl_price[$order_id_product]; ?>" />
                                </div>
                                
                            </div>
                        </td>
                    </tr>
<?php
                    }
                    $ttl_all 		= $ttl_price[$order_id_product] 	+ $ttl_all;
                    $quantity_all 	= $jumlah_order[$order_id_product] 	+ $quantity_all;
                }
?>	
                </tbody>
            </table>
        </div>
    </section>
    <div class="purchasing_btn footer_btn">
        <div class="pull-left" style="padding-top:5px">
            <span>
                <b>Total :  
                    <span style="font-size:17px" id="total_belanja">
                        <?php echo $itshijab->money("Rp.",@$ttl_all); ?> 
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
    <?php }else{?>
    	
        <div class="login-cart">
            <span id="msg_spot"></span>
            <div class="col-md-5" style="position:relative">
                
                <form method="post" action="" name="form-x" style="position:fixed">
                    <div id="tr_form_login">
                        <div><small>NB : Tanda <label class="req"></label> wajib di isi</small></div>
                        <div class="form-group">
                            <label class="req">Email</label>
                            <input type="email" name="cust_email" id="cust_email" class="form-control lowercase">
                        </div>
                        <div class="form-group">
                            <input type="radio" name="pelanggan" class="plg" value="baru" onclick="ch_cust(this)" checked/> Saya adalah pelanggan baru<br />
                            <input type="radio" name="pelanggan" class="plg"value="lama" onclick="ch_cust(this)"/> Saya adalah pelanggan lama<br />
                        </div>
                        <div class="form-group" style="display:none;" id="key_pass">
                            <label class="req">Password</label>
                            <input type="password" name="cust_password" id="cust_password" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="checkbox">&nbsp;Ingat saya - <a href="#">Lupa Password?</a>
                        </div>
                    </div>
                </form>
                <div id="tr_form_location" style="display:none">
                    <div><small>NB : Tanda <label class="req"></label> wajib di isi</small></div>
                    <div class="form-group">
                        <label class="req">Nama Penerima</label>
                        <input type="email" name="cust_name" id="cust_name" class="form-control uppercase">
                    </div>
                    <div class="form-group">
                        <label class="req">Lokasi Penerima</label>
                        <select class="form-control" id="jne_propinsi" name="propinsi">
                            <option value="">-PILIH PROPINSI--</option>
                            <?php
                            /*$q_propinsi = $db->query("SELECT * FROM ".$tpref."tarif_jne_master GROUP BY PROVINCE ORDER BY PROVINCE ASC");
                            while($dt_propinsi = $db->fetchNextObject($q_propinsi)){?>
                            <option value="<?php echo $dt_propinsi->PROVINCE; ?>"><?php echo $dt_propinsi->PROVINCE; ?></option>
                            <?php }*/ ?>
                        </select>
                    </div>
                    <div class="form-group" id="jne_lokasi"></div>
                    <div class="form-group" id="jne_package"></div>
                    <div class="form-group">
                        <label class="req">Alamat Penerima</label>
                        <textarea name="cust_add" id="cust_add" class="form-control uppercase"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="req">No.HP Penerima</label>
                        <input type="text" name="cust_hp" id="cust_hp" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Informasi Tambahan (optional)</label>
                        <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-7" style="margin:0;padding:0">
                <table width="100%" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                          <th width="18%" style="text-align:center">Photo</th>
                          <th width="22%" style="text-align:center">Qty</th>
                          <th width="37%" style="text-align:right">Harga</th>
                          <th width="23%" style="text-align:center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
        <?php		$ttl_all 		= 0;
                    $quantity_all	= 0;
                    $a 				= 0;
                    foreach(array_reverse($_SESSION['order_id_product']) as &$order_id_product){
						$datas		= array("id_product"=>$order_id_product);
						$results  	= $itshijab->viewProduct($datas); 
						
						if(count($results) > 0){ //print_r($results[1]);
						$nm_product	 	= $results[1]['nama'];
						$pr_price	   	= $results[1]['harga'];
						
						$jumlah_order[$order_id_product]   	= 7;
						if(!empty($_COOKIE['jumlah_order'][$order_id_product])){ 
							$jumlah_order[$order_id_product] = $_COOKIE['jumlah_order'][$order_id_product];
						}
						$ttl_price[$order_id_product]  	= $pr_price*$jumlah_order[$order_id_product];
						if(!empty($_COOKIE['ttl_price'][$order_id_product])){ 
							$ttl_price[$order_id_product] = $_COOKIE['ttl_price'][$order_id_product];
						}
        ?>                   
                            <tr>
                              <td colspan="4" class="cart_product" >
                                    <input type="hidden" class="list_id" value="<?php echo $order_id_product; ?>"/>
                                    <small><?php echo @$results[1]['code']; ?> - <?php echo @$nm_product; ?></small>
                              </td>
                            </tr>
                            <tr id="tr_<?php echo @$order_id_product; ?>">
                                <td class="cart_product" style="text-align:center" >
                                    <div class="thumbnail" style="margin-bottom:5px">
                                        <div style="max-height:40px; overflow:hidden">
                                    		<img src="<?php echo $results[1]['photo']; ?>" style="width:100%"/>
                                        </div>
                                    </div>
                                </td>
                                <td style="text-align:center">
                                <?php echo @$quantities[$a]; ?>
                                <input type="hidden" id="quantity_<?php echo $order_id_product; ?>" value="<?php echo @$quantities[$a]; ?>">
                                </td>
                                <td style="text-align:right">
                                    <?php echo $itshijab->money("",@$results[1]['harga']); ?>
                                    <input type="hidden" id="price_<?php echo $order_id_product; ?>" 
                                           value="<?php echo @$results[1]['harga']; ?>" />
                                </td>
                                <td style="text-align:center">
                                    <input type="hidden" class="list_id" value="<?php echo $order_id_product; ?>"/>
                                    <button type="button" value="<?php echo $order_id_product; ?>" class="btn cancel-cart" style="margin:0 6px 0 0;" title="Batalkan"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>Subtotal</td>
                                <td></td>
                                <td style="text-align:right">
                                    <?php echo $itshijab->money("Rp.",@$ttl_price[$order_id_product]); ?>
                                    <input type="hidden" id="total_price_<?php echo $order_id_product; ?>" value="<?php echo @$ttl_price[$order_id_product]; ?>" />
                                </td>
                                <td></td>
                            </tr>
        <?php
						}
                    $ttl_all 		= $ttl_price[$order_id_product] 	+ $ttl_all;
                    @$quantity_all 	= $quantities[$a] 					+ $quantity_all;
                    $a++;
                    }
        ?>	
                    </tbody>
                </table>
            </div>
      		<div class="clearfix"></div>      
        </div>
        <div class="clearfix"></div>
        <div class="footer_btn" >
            <div class="pull-left">
            <button type="button" class="btn btn-primary login-btn" value="login" style="margin-top:0; margin-left:8px">
                <i class="fa fa-hand-o-right"></i> Lanjutkan
            </button>
            <button type="button" class="btn btn-primary checkout-btn" value="checkout" style="display:none;margin-top:0; margin-left:8px">
                <i class="fa fa-shopping-cart"></i> Checkout
            </button> <span id="load_spot"></span>
            </div>
            <div class="pull-right" style="padding-top:5px">
                <span>
                    <b>Total :  
                        <span style="font-size:17px" id="total_belanja">
                            <?php echo $itshijab->money("Rp.",@$ttl_all); ?> 
                        </span> 
                        (<span id="jumlah_belanja"><?php echo @$quantity_all; ?></span> ITEM)
                    </b>
                </span>
                <input type="hidden" id="real_total_belanja" value="<?php echo @$ttl_all; ?>"/>
            </div>
        </div>
        
        
    <?php } ?>
    
	<div class="clearfix"></div>