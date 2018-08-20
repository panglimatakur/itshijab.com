config  	= JSON.parse('{'+$("#config").val()+'}');
dirhost 	= config.dirhost;
page 		= config.page;
var files; 
var file_id = $("#file_id").val();

function formula_harga_cetak(){
	harga_pola 				= $("#tipe option:selected").attr("data-price");
	harga_kain 				= $("#jenis_kain option:selected").attr("data-price");
	harga_design 			= $("#harga_design").val();
	harga_design_service 	= $("#harga_design_service").val();
	
	harga_dasar				= +harga_pola + +harga_kain;
	jumlah_cetak			= $("#jumlah_cetak").val();
	harga_cetak  			= (+harga_dasar * +jumlah_cetak) + (+harga_design_service + +harga_design);
	if(jumlah_cetak > 3){ 	harga_cetak = +harga_cetak - 20000; }
	
	/*alert("(harga_dasar : "+harga_dasar+" * jumlah_cetak: "+jumlah_cetak+") + (harga_design :"+harga_design+" + harga_design_service: "+harga_design_service+") ");*/
	
	$("#harga_cetak").val(harga_cetak);
	label_harga_cetak = accounting.formatMoney(harga_cetak,"Rp.",2,".",",");
	$("#label_harga").val(label_harga_cetak);

}



$(function () {	

	vheight 	= $("#layer_1").height();
	bodyHeight 	= $("body").width();
	if(bodyHeight < 300){ $(".help_ukuran").hide(); }
	else				{ $(".help_ukuran").show(); }

	if(vheight < 300){
		$(".right-desain").css({"height":"auto","overflow":"hidden"});
	}else{
		$(".right-desain").slimScroll({
		  wheelStep: 10,
		  height : '350px',
		});
	}

	$(".custom_canvas").height(vheight);

	$('#imgInp').on('change',function prepareUpload(event){
		$("#harga_design_service").val(50000);
		files = event.target.files;
		$("#src").empty();
		var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
		$($(this)[0].files).each(function () {
			var file = $(this);
			if (regex.test(file[0].name.toLowerCase())) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$('#layer_3').show().attr('src', e.target.result);
					$("#custom-desain").slideDown("fast");
				}
				reader.readAsDataURL(file[0]);
			} else {
				bootbox.alert("<strong style='color:#CC0000'>"+file[0].name + "</strong> format file tidak di dizinkan");
				return false;
			}
		});

		$("#form_ownership").hide();
		$("#form_design_service").show();
		$("#designer_info").show();
		$("#jumlah_cetak").val('1');
		$('#ownership').val('');
		formula_harga_cetak();
	})
	$('#raw_design').on('change',function prepareUpload(event){
		files 		= event.target.files;
		var regex 	= /^([a-zA-Z0-9\s_\\.\-:])+(.ai|.cdr|.svg)$/;
		$($(this)[0].files).each(function () {
			var file = $(this);
			if (!regex.test(file[0].name.toLowerCase())) {
				bootbox.alert("<strong style='color:#CC0000'>"+file[0].name+"</strong> tidak di izinkan, format file yang di dizinkan adalah berupa *.ai (Adobe Illustrator) / *.cdr (Corel Draw) / *.svg (Scalable Vector Graphics)");
				return false;
			}
		});

	})
	
	$(".default_design").on("click",function(e){
		$("#harga_design_service").val('');
		$("#form_ownership").show();
		$("#form_design_service").hide();
		$("#designer_info").hide();
		$("#jumlah_cetak").val('1');

		$("#imgInp").val("");
		$("#raw_design").val("");

		formula_harga_cetak();
		e.preventDefault();
		path 		= $(this).attr("src");
		id_default 	= $(this).attr("data-id");
		$('#layer_3').show().attr('src',path);
		$("#custom-desain").slideDown("fast");
		$("#src").val(id_default);
	})

	$("#tipe").on("change",function(){
		tipe = $(this).val();
		if(tipe == "1"){
			$("#layer_1").attr("src","files/images/experiment/pashmina.png");
			$("#layer_3").css({"width":"93%","height":"75%","margin-top":"13%","margin-left":"4%"});	
			$(".download_pola a").attr("href","files/images/experiment/pashmina.png");
		}

		if(tipe == "2"){
			$("#layer_1").attr("src","files/images/experiment/segiempat.png");
			$("#layer_3").css({"width":"64%","height":"120%","margin-top":"8%","margin-left":"15%","margin-bottom":"18%"});		
			$(".download_pola a").attr("href","files/images/experiment//segiempat.png");
		}
		formula_harga_cetak();
	})

    $('#demo_forceformat').colorpicker().on('changeColor', function() {
      color = $(this).val();
	  $(".inner-bg, .btn-secondary").css("background-color",color);
	});

	$("#ownership").on("change",function(){
		ownership 		= $(this).prop('checked');
		harga_design 	= $(this).attr("data-price");
		if(ownership == true){
			$("#harga_design").val(harga_design);
		}else{
			$("#harga_design").val("");
		}
		formula_harga_cetak();
	})

	$("#jumlah_cetak").on("change keyup",function(){
		if($(this).val() > 0){
			jumlah_cetak		= $(this).val();
		}else{
			$(this).val("1");
		}
		formula_harga_cetak();
	})

	$(".plus").on("click",function(){
		jumlah_cetak		= $("#jumlah_cetak").val();
		if(jumlah_cetak > 0){
			jumlah_cetak++;
		}else{
			jumlah_cetak		= 1;
		}
		$("#jumlah_cetak").val(jumlah_cetak);
		formula_harga_cetak();
	})
	$(".minus").on("click",function(){
		jumlah_cetak		= $("#jumlah_cetak").val();
		if(jumlah_cetak < 0){
			jumlah_cetak--;
		}else{
			jumlah_cetak		= 1;
		}
		$("#jumlah_cetak").val(jumlah_cetak);
		formula_harga_cetak();
	})
	$("#jenis_kain").on("change",function(){
		formula_harga_cetak();
	})

	//DESIGN TOOLS
	cur_width = $("#lebar").val();
	$("#l_tambah").mousehold(function() {
		cur_width++;
		$("#lebar").val(cur_width);
		$("#layer_3").width(cur_width+"%");
	})

	$("#l_kurang").mousehold(function() {
		cur_width--;
		$("#lebar").val(cur_width);
		$("#layer_3").width(cur_width+"%");
	})
	
	cur_height = $("#tinggi").val();
	$("#t_tambah").mousehold(function() {
		cur_height++;
		$("#tinggi").val(cur_height);
		$("#layer_3").height(cur_height+"%");
	})
	$("#t_kurang").mousehold(function() {
		cur_height--;
		$("#tinggi").val(cur_height);
		$("#layer_3").height(cur_height+"%");
	})
	
	cur_updown = $("#atbaw").val();
	$("#atas").mousehold(function() {
		cur_updown--;
		$("#atbaw").val(cur_updown);
		$("#layer_3").css("margin-top",cur_updown+"%"); 
	})
	$("#bawah").mousehold(function() {
		cur_updown++;
		$("#atbaw").val(cur_updown);
		$("#layer_3").css("margin-top",cur_updown+"%"); 
	})
	
	cur_rightleft = $("#kika").val();
	$("#kanan").mousehold(function() {
		cur_rightleft++;
		$("#kika").val(cur_rightleft);
		$("#layer_3").css("margin-left",cur_rightleft+"%"); 
	})
	$("#kiri").mousehold(function() {
		cur_rightleft--;
		$("#kika").val(cur_rightleft);
		$("#layer_3").css("margin-left",cur_rightleft+"%"); 
	})
	//END OF DESIGN TOOLS



	$("#viewRoom").on("click",function(){
		$.ajax({
			url			: dirhost+'/zendfront/pages/'+page+'/ajax/proses.php',
			type 		: "POST",
			dataType 	: 'json',
			data 		: {"direction":"view_desain"},
			success 	: function(result) {
				$("#desainRoomModal").modal("show");
				$("#desainRoomModal .modal-body").html(result.content);
			}
		})
	})

	$("#addToRoom").on("click",function submitForm(event){
		event.stopPropagation();
		event.preventDefault(); 

		$('html, body').css({
			overflow: 'hidden',
			height: '100%'
		});

		$.blockUI({ message: '<div style="text-align:center; color:#FFF;"><img src="files/images/bars.svg" /><br><b>Sedang membangun pola desain, mohon tunggu sebentar</b></div>', css: {backgroundColor:"none",border:"none"} });
		next 			= "";
		fileimage	 	= "";
		fileraw	 	 	= "";
		var regex_pic 	= /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png)$/;
		var regex_raw 	= /^([a-zA-Z0-9\s_\\.\-:])+(.ai|.cdr)$/;

		var data 	 	= new FormData();
		var formData 	= $("#form_desain").serialize();
		var src 	 	= $("#src").val();

		if(src == ""){
			var file_image 	= document.getElementById("imgInp");
			var file_raw 	= document.getElementById("raw_design");

			if(file_image.value){
				if(regex_pic.test(file_image.files[0].name.toLowerCase())){
					data.append("file_image", file_image.files[0]);
					fileimage += file_id+'_'+file_image.files[0].name;
					next = "done";
				}else{
					$.unblockUI();
					bootbox.alert("Format file \"Pratinjau Desain\" tidak di izinkan, harus berformat *.jpg,*.jpeg,*.gif atau *.png");
					reset_body();
					next = "";	
				}
			}

			

			if(file_raw.value != "" && next == "done"){
				if(regex_raw.test(file_raw.files[0].name.toLowerCase())){
					data.append("file_raw", file_raw.files[0]);
					fileraw += file_id+'_'+file_raw.files[0].name;
					next = "done";
				}else{
					$.unblockUI();
					bootbox.alert("Format file rancangan desain mentah tidak di izinkan, harus berformat *.cdr atau *.ai");
					reset_body();
					next = "";
				}
			}
			formData 		= formData + '&file_id='+file_id+'&fileimage='+fileimage+"&fileraw="+fileraw;
		}else{
			formData 		= formData + '&src='+src;
			next = "done";	

		}

		if(next == "done"){
			$.ajax({
				url			: dirhost+'/zendfront/pages/'+page+'/ajax/proses.php?direction=save_desain&files&'+formData,
				type 		: "POST",
				data 		: data,
				cache		: false,
				dataType 	: 'json',
				processData	: false, 
				contentType	: false, 
				crossdomain	: false,
				success 	: function(result) {
					if(result.io == 2){
						var id_design = result.id_design;
						html2canvas(document.getElementById("custom_canvas"), {
						  onrendered: function(canvas) {
							screenshot = canvas.toDataURL("image/png");
							$.ajax({
								url			: dirhost+'/zendfront/pages/'+page+'/ajax/proses.php',
								type 		: "POST",
								dataType 	: 'json',
								data 		: {"direction":"save_screenshot","screenshot":screenshot,"id_design":id_design},
								success 	: function(result) {
									reset_body(); 
									$.unblockUI();
									$("#desainRoomModal").modal("show");
									$("#desainRoomModal .modal-body").html(result.content);
								},error: function (xhr, ajaxOptions, thrownError) {
									alert(xhr.status);
									alert(thrownError);
								}
							})
						  }
						});
					}else{
						$.unblockUI();
						bootbox.alert(result.msg);	
						reset_body();
					}
				},error: function (xhr, ajaxOptions, thrownError) {
					alert(xhr.status);
					alert(thrownError);
				}
			})
		}
	});
})


function reset_body(){
	$('html, body').css({
		overflow: 'auto',
		height: 'auto'
	});
}

function open_login(){
	$("#form_login").slideDown();
	$("#form_register").slideUp();
}

function open_register(){
	$("#form_login").slideUp();
	$("#form_register").slideDown();
}

function save_customer(){
	order_name 		= $("#order_name").val();
	order_hp 		= $("#order_hp").val(); 
	order_email 	= $("#order_email").val(); 
	order_password 	= $("#order_password").val(); 
	order_kpassword = $("#order_kpassword ").val();
	order_address 	= $("#order_address").val();

	if(order_name != "" && order_hp != "" && order_email != "" && 
	   order_password != "" && order_kpassword != "" && order_address != ""){
		if(order_password == order_kpassword){
			$("#design_loader").html("<div style='text-align:center; margin-bottom:4px;'><img src='files/images/loader_v.gif'></div>");
			$.ajax({
				url			: dirhost+'/zendfront/pages/'+page+'/ajax/proses.php',
				type 		: "POST",
				dataType 	: 'json',
				data 		: {"direction":"save_customer","order_name":order_name,"order_hp":order_hp,"order_email":order_email,"order_password":order_password,"order_address":order_address},
				success 	: function(result) {
					if(result.io == 2){
						//$("#btn_order").slideDown();
						$("#form_login").slideUp();
						$("#form_register").slideUp();
					}
					$("#design_loader").empty();
					$("#msg_register").html(result.msg);
				}
			})
		}else{
			bootbox.alert("Password anda tidak sama, silahkan ulangi...");
		}
	}else{
		bootbox.alert("Pengisian form belum lengkap, silahkan ulangi...");
	}

}

function save_login(){
	$("#design_loader").html("<div style='text-align:center; margin-bottom:4px;'><img src='files/images/loader_v.gif'></div>");
	cemail 			= $("#cemail").val(); 
	cpassword 		= $("#cpassword").val(); 
	$.ajax({
		url			: dirhost+'/zendfront/pages/'+page+'/ajax/proses.php',
		type 		: "POST",
		dataType 	: 'json',
		data 		: {"direction":"save_login","cemail":cemail,"cpassword":cpassword},
		success 	: function(result) {
			if(result.io == 2){
				$("#btn_order").slideDown();
				$("#form_login").slideUp();
				$("#form_register").slideUp();
				$("#msg_register").empty();
				$("#id_login").val(result.id_login);
			}else{
				$("#msg_register").html(result.msg);
			}
			$("#design_loader").empty();	
		}
	})

}

function order_design(id_design){
	login_id = $("#id_login").val();
	$("#desainRoomModal").modal("hide");
	$.blockUI({ message: '<div style="text-align:center; color:#FFF;"><img src="files/images/bars.svg" /><br><b>Sedang memproses pemesanan desain, mohon tunggu sebentar</b></div>', css: {backgroundColor:"none",border:"none"} });
	$.ajax({
		url			: dirhost+'/zendfront/pages/'+page+'/ajax/proses.php',
		type 		: "POST",
		dataType 	: 'json',
		data 		: {"direction":"order_desain","login_id":login_id},
		success 	: function(result) {
			$("#desainRoomModal .modal-body").empty();
			$("#desainRoomModal").modal("hide");
			$.unblockUI();
			bootbox.alert(result.msg);
		},error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
		}
	})
}

function delete_design(id_design){
	bootbox.confirm("Kamu yakin menghapus pilihan desain ini?",function(confirmed){
		if(confirmed == true){
			$("#design_loader").html("<div style='text-align:center; margin-bottom:4px;'><img src='files/images/loader_v.gif'></div>");
			$.ajax({
				url			: dirhost+'/zendfront/pages/'+page+'/ajax/proses.php',
				type 		: "POST",
				dataType 	: 'json',
				data 		: {"direction":"delete_design","id_design":id_design},
				success 	: function(result) {
					$("#design_"+id_design).fadeOut();
					$("#design_loader").empty();	
				}
			})
		}
	})

}

