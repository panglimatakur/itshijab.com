var config  	= JSON.parse("{"+$("#config").val()+"}");
var basepath 	= config.dirhost+"/"+config.position+"/";
var dirhost 	= config.dirhost;
function reset_total_belanja(){
	total_belanja		= $("#real_total_belanja").val();
	new_total_belanja	= accounting.formatMoney(total_belanja,"Rp.","",".",",");
	$("#total_belanja").html(new_total_belanja);	
}
function ch_cust(el){
	value = $(el).val();
	if(value == "lama"){
		$("#key_pass").fadeIn(200);	
	}else{
		$("#key_pass").fadeOut(200);	
	}
}
function get_package(el){
	reset_total_belanja();
	propinsi = $("#jne_propinsi").val();
	$("#jne_package").html("<i class='fa fa-circle-o-notch fa-spin fa-fw'></i> Mengambil Data...");
	lokasi 	 = $(el).val();	
	$.ajax({
		url  : basepath+"pages/cart/ajax/data.php",
		type : "POST",
		data : {"direction":"get_package","propinsi":propinsi,"lokasi":lokasi},
		success: function(response){
			$("#jne_package").html(response);
		}
	});
}
function add_tarif(el){
	reset_total_belanja();
	type 				= $(el).val();
	fee 				= $("#paket option:selected").data('info');
	total_belanja 		= $("#real_total_belanja").val();
	new_total_belanja	= +total_belanja + +fee;
	new_total_belanja	= accounting.formatMoney(new_total_belanja,"Rp.","",".",",");
	$("#total_belanja").html(new_total_belanja);
}
$(document).ready(function(){
	$("#cust_hp").on("keyup",function(e){
		if (/\D/g.test(this.value)) {
			this.value = this.value.replace(/\D/g, '');
		}
	});
	$("#jne_propinsi").on("change",function(){
		reset_total_belanja();
		$("#jne_lokasi").html("<i class='fa fa-circle-o-notch fa-spin fa-fw'></i> Mengambil Data...");
		propinsi = $(this).val();	
		$("#jne_package").empty();
		$.ajax({
			url  : basepath+"pages/cart/ajax/data.php",
			type : "POST",
			data : {"direction":"get_location","propinsi":propinsi},
			success: function(response){
				$("#jne_lokasi").html(response);
			}
		});
	})
	$(".checkout-btn").on("click",function(){
		var plg 		= $(".plg:checked").val();
		var cust_email	= $("#cust_email").val();
		if(plg == "baru"){
			var cust_password	= "";
		}else{
			var cust_password	= $("#cust_password").val();
		}
		delivery_type 		= "";
		destination_code	= "";
		name 				= $("#cust_name").val();
		if($("#paket").length > 0)		{ delivery_type 	= $("#paket").val(); 		}
		if($("#dest_code").length > 0)	{ destination_code 	= $("#dest_code").val();	}
		alamat			 	= $("#cust_add").val();
		keterangan			= $("#keterangan").val();
		cust_hp				= $("#cust_hp").val();
		
		$("#load_spot").html("<i class='fa fa-circle-o-notch fa-spin fa-fw'></i> Mohon tunggu sebentar...");
		if(name != "" && delivery_type != "" && destination_code != "" && alamat != "" && cust_hp != "" && 
		  ((plg == "baru" && cust_email != "") || (plg == "lama" && cust_email != "" && cust_password != ""))){ 
		  
			id_products = [];
			quantities 	= [];
			$(".list_id").each(function() {
				id_product = $(this).val();
				id_products.push(id_product);
				quantity = $("#quantity_"+id_product).val();
				quantities.push(quantity);
			});
			
			$.ajax({
				url  : basepath+"pages/cart/ajax/proses.php",
				type : "POST",
				data : {"direction":"checkout","plg":plg,"cust_email":cust_email,"cust_password":cust_password,"id_products":id_products,"quantities":quantities,"name":name,"delivery_type":delivery_type,"destination_code":destination_code,"alamat":alamat,"cust_hp":cust_hp,"keterangan":keterangan},
				success: function(response){
					if($.trim(response) != 2){
						$("#msg_spot").html(response);
						$("#load_spot").empty();
					}else{
						$('.modal.in').modal('hide');
						bootbox.alert("<div class='col-md-3' style='padding-right:0'><img src='"+dirhost+"/files/images/users/jhoty.jpg' style='width:100%' class='thumbnail'></div><div class='col-md-9' style='text-align:justify'>Hai, perkenalkan nama saya <b>Astri 'Igh Waw' Lestari Ningsih</b> sebut saja <b>Mawar Bedarah</b>, sebagai billing di itshijab.com, Terimakasih banyak sudah memberi kepercayaan kepada kami, informasi pesanan anda sudah kami terima, silahkan ikuti proses pembayaran selanjutnya sebesar <code>"+accounting.formatMoney(current_total,"Rp.","",".",",")+"</code> yang telah kami kirimkan ke email <code>"+cust_email+"</code></div><div class='clearfix'></div>");
					}
				}
			});
		}else{
			$(".modal-body").animate({scrollTop:0}, '10', 'swing', function() {});
			$("#load_spot").empty();
			$("#msg_spot").html("<div class='alert alert-danger'>Pengisian form belum lengkap, silahkan periksa kembali</div><div class='clear'></div>");	
		}
	})
	
	$(".login-btn").on("click",function(){
		var plg 		= $(".plg:checked").val();
		var cust_email	= $("#cust_email").val();
		if(plg == "baru"){
			var cust_password	= "";
			done = 1;
		}else{
			var cust_password	= $("#cust_password").val();
			if(cust_password != "")	{ done = 1; }
		}
		if(cust_email != "" && done == 1){
			$.ajax({
				url  : basepath+"pages/cart/ajax/proses.php",
				type : "POST",
				data : {"direction":"check_new_cust","plg":plg,"cust_email":cust_email,"cust_password":cust_password},
				success: function(response){
					if(response == 2){
						$("#tr_form_location").slideDown(200);
						$("#tr_form_login").slideUp(200);
						$(".checkout-btn").show();
						$(".login-btn").hide();
					}else{
						$("#msg_spot").html(response);	
					}
				}
			});
		}else{
			$("#msg_spot").html("<div class='alert alert-danger'>Pengisian form belum lengkap, silahkan periksa kembali</div><div class='clear'></div>");	
		}
		
	})
	
	$(".cart_quantity_up").on("click",function(){
		id_product 				= $(this).attr("data-title");
		var current_price		= $("#price_"+id_product).val();
		var current_sum 		= $("#quantity_"+id_product).val();
		
		var new_current_sum		= +current_sum + 1;
		var new_current_price	= +current_price * +new_current_sum;
		
		$("#quantity_"+id_product).val(new_current_sum);
		cookies.set('jumlah_order['+id_product+']', new_current_sum);
		$("#total_price_"+id_product).val(new_current_price);
		cookies.set('ttl_price['+id_product+']', new_current_price);

		new_current_price_label = accounting.formatMoney(new_current_price,"Rp.","",".",",");
		$("#cart_total_price_"+id_product).val(new_current_price_label);
		
		current_total_sum 		= $("#jumlah_belanja").html();
		new_total_sum			= +current_total_sum + 1;
		$("#jumlah_belanja").html(new_total_sum);
		
		current_total 			= $("#current_total").val();
		new_current_total		= +current_total + +current_price;
		new_total				= accounting.formatMoney(new_current_total,"Rp.","",".",",");
		$("#total_belanja").html(new_total);
		$("#current_total").val(new_current_total);
	})
	
	$(".cart_quantity_down").on("click",function(){
		id_product 				= $(this).attr("data-title");
		var current_price		= $("#price_"+id_product).val();
		var current_sum 		= $("#quantity_"+id_product).val();
		
		var new_current_sum		= +current_sum - 1;
		if(new_current_sum < 1){ new_current_sum = 1; }
		var new_current_price	= +current_price * +new_current_sum;
		
		$("#quantity_"+id_product).val(new_current_sum);
		cookies.set('jumlah_order['+id_product+']', new_current_sum);
		$("#total_price_"+id_product).val(new_current_price);
		cookies.set('ttl_price['+id_product+']', new_current_price);
		
		new_current_price_label = accounting.formatMoney(new_current_price,"Rp.","",".",",");
		$("#cart_total_price_"+id_product).val(new_current_price_label);
	
		current_total_sum 		= $("#jumlah_belanja").html();
		new_total_sum			= +current_total_sum - 1;
		if(new_total_sum < 1){ new_total_sum = 1; }
		$("#jumlah_belanja").html(new_total_sum);
		
		current_total 			= $("#current_total").val();
		new_current_total		= +current_total - +current_price;
		new_total				= accounting.formatMoney(new_current_total,"Rp.","",".",",");
		$("#total_belanja").html(new_total);
		$("#current_total").val(new_current_total);
	})
	
	$(".cancel-cart").on("click",function(){
		id_product 				= $(this).val();
		current_quantities		= $("#quantity_"+id_product).val();
		current_subtotal		= $("#total_price_"+id_product).val();
		$("#del_loader_"+id_product).html("<i class='fa fa-circle-o-notch fa-spin fa-fw'>"); 
		$('.cancel-cart').hide();
		$.ajax({
			url  : basepath+"pages/cart/ajax/proses.php",
			type : "POST",
			data : {"direction":"delete_cart",
					"id_product":id_product,
					"current_quantities":current_quantities,
					"current_subtotal":current_subtotal},
			success: function(response){
				$('.cancel-cart').show();
				$("#tr_"+id_product).fadeOut(200);
				cookies.remove('jumlah_order['+id_product+']');
				cookies.remove('ttl_price['+id_product+']');
				
				var current_sum 		= $("#quantity_"+id_product).val();
				current_total_sum 		= $("#jumlah_belanja").html();
				new_total_sum			= +current_total_sum - +current_sum;
				$("#jumlah_belanja").html(new_total_sum);
				
				var current_subtotal 	= $("#total_price_"+id_product).val();
				current_total 			= $("#current_total").val();
				new_current_total		= +current_total - +current_subtotal;
				new_total				= accounting.formatMoney(new_current_total,"Rp.","",".",",");
				$("#total_belanja").html(new_total);
				$("#current_total").val(new_current_total);
			}
		});
	})
	
	$(".purchase-cart").on("click",function(){
		$(".purchasing_btn").hide().after("<div id='load_purchase' style='margin-top:6px;'><i class='fa fa-circle-o-notch fa-spin fa-fw'></i> Mohon tunggu sebentar...</div>");
		id_products = [];
		quantities 	= [];
		$(".list_id").each(function() {
			
			id_product = $(this).val();
			id_products.push(id_product);
			quantity = $("#quantity_"+id_product).val();
			quantities.push(quantity);
		});
		current_total 			= $("#current_total").val();
		$.ajax({
			url  : basepath+"pages/cart/ajax/proses.php",
			type : "POST",
			data : {"direction":"purchase_cart","id_products":id_products,"quantities":quantities},
			success: function(response){
				$("#load_purchase").remove();
				if(response != 2){
					$(".modal-shopping-cart .modal-body").html(response);
					$(".login-btn").show();
				}else{						
					$('.modal.in').modal('hide');
					bootbox.alert("<div class='col-md-3' style='padding-right:0'><img src='"+dirhost+"/files/images/users/jhoty.jpg' style='width:100%' class='thumbnail'></div><div class='col-md-9' style='text-align:justify'>Hai, perkenalkan nama saya <b>Astri 'Igh Waw' Lestari Ningsih</b> sebut saja <b>Mawar Bedarah</b>, sebagai billing di itshijab.com, Terimakasih banyak sudah memberi kepercayaan kepada kami, informasi pesanan anda sudah kami terima, silahkan ikuti proses pembayaran selanjutnya sebesar <code>"+accounting.formatMoney(current_total,"Rp.","",".",",")+"</code> yang telah kami kirimkan ke email <code>"+cust_email+"</code></div><div class='clearfix'></div>");
				}
			}
		});
	})
	
})
