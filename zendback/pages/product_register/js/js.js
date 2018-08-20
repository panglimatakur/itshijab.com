
$(function(){
	
	$("#nama_kat").on("keyup",function(){
		nkat = $(this).val().length;
		if(nkat > 0){
			$("#div_form_link").slideDown(200);
		}else{
			$("#div_form_link").slideUp(200);
		}
	})
	$(".new_cat").on("click",function(){
		var id_type 	= $("#id_type").val();
		kategori_page 	= $("#kategori_page").val();
		$(".clist").remove();
		$.fancybox.open([{
			type	: 'ajax',
			href 	: kategori_page+"?display=input_kategori&id_type="+id_type,                
			title 	: 'Tambah Kategori Produk'
		}], 
		{padding : 10});
	})
	$("#kategori_type").on("change",function(){
		jenis = $(this).val();
		if(jenis == "anak"){
			$("#div_kategori_induk").html('<div style="text-align:center;"><img src="files/images/loader_v.gif"></div>');
			var id_type 	= $("#id_type").val();
			kategori_page 	= $("#kategori_page").val();
			$.ajax({
				url 	: kategori_page,
				type 	: "POST",
				data 	: {"display":"kategori_proses","form_add":"true","id_type":id_type,"kategori_type":jenis},
				success : function(response){
					$("#div_kategori_induk").html(response);
				}
			});
		}else{
			$("#div_kategori_induk").empty();
		}
	})
	
	$("#new_category").on("click",function(){
		var id_type 		= $("#new_id_type").val();
		var parent_id		= $("#parent_id").val();
		var nama_kategori 	= $("#nama_kat").val();
		proses_page 		= $("#proses_page").val();
		$("#div_new_kat").html('<div class="formSep"><img src="files/images/loader_v.gif"></div>');
		$.ajax({
			url 	: proses_page,
			type 	: "POST",
			data 	: {"direction":"add_new_category","parent_id":parent_id,"id_type":id_type,"nama_kategori":nama_kategori},
			success : function(response){
				result = JSON.parse(response);
				if(result['msg'] == "berhasil"){
					show_catlist(result['value']);
					$("#div_new_kat").empty();
					$.fancybox.close();
				}
			}
		});
	})

	$("#id_type_report").on("change",function(){
		data_page 	= $("#kategori_page").val();
		type		= $(this).val();
		if(type != ""){
			$("#div_kategori_report").html("<img src='files/images/loader_v.gif' style='margin-left:2%'>");
			$.ajax({
				url		: data_page,
				type	: "POST",
				data 	: {"display":"kategori_report","id_type_report":type},
				success : function(response){
					$("#div_kategori_report").html(response);	
				}
			})
		}else{
			$("#div_kategori_report").html("");	
		}
	})
	$("#select_rows").on("click",function(){
		ch = $(this).is(":checked");
		if(ch == true){
			$(".row_sel").attr("checked","checked");
		}else{
			$(".row_sel").removeAttr("checked");	
		}
	})
	$("#select_rows_2").on("click",function(){
		ch = $("#select_rows").is(":checked");
		if(ch == true){
			$("#select_rows").removeAttr("checked");	
			$(".row_sel").removeAttr("checked");	
		}else{
			$("#select_rows").attr("checked","checked");
			$(".row_sel").attr("checked","checked");
		}
	})
	$("#delete_picked").on("click",function(){
		if(confirm("Dengan menghapus data produk ini, data penjualan, pembelian dan distribusi yang sudah di daftarkan sebelumnya akan kehilangan relasi data produk/bahan ini, Anda yakin menghapus data produk Ini?")){
			proses_page = $("#proses_page").val();
			$(".row_sel").each(function() {
			   ch 		= $(this).is(":checked");
			   ch_val 	= $(this).val();
			   if(ch == true){
				$.ajax({
					url		: proses_page,
					type	: "POST",
					data 	: {"direction":"delete","no":ch_val},
				})
				$("#tr_"+ch_val).fadeOut(500);	   
			   }
			});
		}
	})	
	
	$("#multi_button").on("click",function(){
		nama_multi 		= $("#nama").val();
		unit_multi 		= $("#satuan").val();
		harga_multi 	= $("#harga").val();
		deskripsi_multi	= $("#deskripsi").val();
		$(".nama_multi").val(nama_multi);
		$(".satuan_multi").val(unit_multi);
		$(".harga_multi").val(harga_multi);
		$(".deskripsi_multi").val(deskripsi_multi);
		$.fancybox.close();
	})
	$(".open_file").on("click",function () {
		info = $(this).attr("data-info");
		$("#image_single_"+info).trigger("click");
	});	
	
	$(".harga_multi").on("keyup",function(){ 
		newval = $(this).val();
		newval = newval.replace(/[^0-9]/g,'');
		$(this).val(newval);
	})
})


function set_status(id){ 
	var proses_page 	= $("#proses_page").val();
	var value 		= $("#st_prod_"+id).val();
	if(value != ""){
		$("#st_prod_"+id).before('<div style="text-align:center;margin:10px" id="st_load_'+id+'"><img src="files/images/loader_v.gif"></div>');
		$.ajax({
			url 	: proses_page,
			type	: "POST",
			data	: {"direction":"set_status","no":id,"id_status":value},
			success : function(data){
				$("#st_load_"+id).remove();
			}
		});
	}
}

function lastPostFunc(){ 
	data_page = $("#data_page").val();
	$('div#lastPostsLoader').html('<div style="text-align:center;margin:10px"><img src="files/images/loader_v.gif"><br>Mengambil Data...</div>');
	var conf 	= JSON.parse("{"+$("#config").val()+"}");
	page		= conf.page;
	lastId	= $(".wrdLatest:last").attr("data-info");
	id_kategori = $("#id_kategori_report").val();
	code 		= $("#code_report").val();
	nama 		= $("#nama_report").val();
	satuan 		= $("#satuan_report").val();
	deskripsi 	= $("#deskripsi_report").val();
	
	$.ajax({
		url 	: data_page,
		type	: "POST",
		data	: {"page":page,"lastID":lastId,"id_kategori":id_kategori,"code":code,"nama":nama,"satuan":satuan,"deskripsi":deskripsi,"display":"list_report"},
		success : function(data){
			if (data != "") {
				$(".wrdLatest:last").after(data)				
			}
			$('div#lastPostsLoader').empty();
		}
	});
};  

function show_catlist(picked){
	var conf = JSON.parse("{"+$("#config").val()+"}");
	data_page 	= $("#kategori_page").val();
	type		= $("#id_type").val();
	$("#last_code").html("");
	if(type != ""){
		$("#div_kategori").html("<img src='files/images/loader_v.gif' style='margin-left:2%'>");
		$.ajax({
			url		: data_page,
			type	: "POST",
			data 	: {"page":conf.page,"display":"kategori_proses","id_type":type,"picked":picked},
			success : function(response){
				$("#div_kategori").html(response);	
			}
		})
	}else{
		$("#div_kategori").html("");	
	}
}

function select_category_report(id_kategori){
	$("#id_kategori_report").val(id_kategori);
	$(".kategori_list_report li").css({"background-color":"#FFFFFF"});
	$("#cat_report_"+id_kategori).css({"background-color":"#D5EAFF"});
}

function select_parent(id){
	$("#parent_id").val(id);
	$("#cat_"+id).css({"font-weight":"bold","color":"#F9ECF7","border":"1px solid #F9ECF7","background-color":"#F9ECF4"});
}
function select_category(id_kategori){
	$("#id_kategori").val(id_kategori);
	$("#cat_"+id_kategori).css("background-color","#D5EAFF");
	$( ".kategori_list li:not(#cat_"+id_kategori+")").css("background-color","#FFF");							
}
function select_cat(id_kategori){
	select_category(id_kategori);
	last_code();
}
function removal(id){
	if(confirm("Dengan menghapus data produk ini, data penjualan, pembelian dan distribusi yang sudah di daftarkan sebelumnya akan kehilangan relasi data produk/bahan ini, Anda yakin menghapus data produk Ini?")){
		proses_page = $("#proses_page").val();
		$.ajax({
			url		: proses_page,
			type	: "POST",
			data 	: {"direction":"delete","no":id},
			success	: function(){
				$("#tr_"+id).fadeOut(500);	
			}
		})
	}
	
}
function last_code(){
	proses_page = $("#proses_page").val();
	id_kategori = $("#id_kategori").val();
	$("#last_code").html("<img src='files/images/loader_v.gif' style='margin-left:4px'>");
	$.ajax({
		url 	: proses_page,
		type 	: "POST",
		data	: {"direction":"check_code","id_kategori":id_kategori},
		success	: function(response){
			if(response != ""){
				$("#last_code").html("(<b>Code Terakhir : </b>"+response+")");
			}else{
				$("#last_code").html("");	
			}
		}
	})
}

function check_element(){
	if($(".product_content").length > 0){
		$("#button_container").show(500);
	}else{
		$("#button_container").hide(500);
	}	
}
function cancel_content(el,id_picture,direction){
	if(confirm("Anda Yakin Menghapus Gambar Ini?")){
			if(direction == "edit"){
				proses_page = $("#proses_page").val();
				$.ajax({
					url 	: proses_page,
					type 	: "POST",
					data	: {"direction":"delete_pic","id_picture":id_picture},
					success	: function(response){
						$("#product_"+el).fadeOut(500,function(){ $(this).remove(); })
					}
				})
			}else{
				$("#"+el).fadeOut(500,function(){ 
					$("#group_"+id_picture).val("");
				})
			}
			check_element();
	}
}


function preview(input,direction) {
	if(direction == ""){ direction = "insert"; }
	var fileList 	= input.files;
    var anyWindow 	= window.URL || window.webkitURL;
	var satuan		= $("#satuan_tag").html();
	var code_rand	= $("#code_random").val();
	var a 			= 0;
	for(var i = 0; i < fileList.length; i++){
	 a++;
	 var counter 	= $("#counter").val();
	 var t 			= +counter+1;
	 jml_all = $(".product_content").length;
	 
	 if($("#product_"+a).length > 0){ a = +jml_all + 1; }
	 if($.trim(t.toString().length) == 1){ t = "0"+t; }
	  var new_counter = +counter+1;
	  var objectUrl = anyWindow.createObjectURL(fileList[i]);
	  
	  if(direction != "edit"){
	  	cclass = "col-md-3";
	  }else{
	  	cclass = "col-md-12";
	  }
	  input_content = 
	  '<div class="product_content '+cclass+'" id="product_'+a+'">'+

		'<div class="tools" style="text-align:center; width:95%;" >'+
			'<a href="javascript:void()" class="btn btn-default btn-cancel" onclick="cancel_content(\'product_'+a+'\',\''+a+'\',\'\')">'+
				'<i class="fa fa-trash"></i>'+
			'</a>'+
		'</div>'+	
	
		'<div class="frame_photo thumbnail">'+
			'<img src="'+objectUrl+'" width="100%" class="picker" id="picker_'+a+'"/>'+
		'</div>';
		if(direction != "edit"){
			input_content += 
				'<input type="hidden" name="group['+a+']" id="group_'+a+'" value="'+a+'">'+
				'<div class="input-group">'+
					'<span class="input-group-addon"><i class="fa fa-qrcode"></i></span>'+
					'<input type="text" name="code_arr[]" value="'+code_rand+'-'+t+'" class="code form-control mousetrap" placeholder="Kode*">'+
				'</div>'+
				'<input type="text" name="nama_arr[]" value="" class="nama_multi form-control mousetrap" placeholder="Nama*">'+
				'<textarea name="deskripsi_arr[]" class="deskripsi_multi mousetrap form-control" placeholder="Deskripsi"></textarea>'+
				'<div class="input-group">'+
					'<span class="input-group-addon">Rp.</span>'+
					'<input type="text" name="harga_arr[]" value="" class="harga_multi mousetrap form-control numeric" placeholder="Harga" onkeyup="numeric(this)">'+
				'</div>'+
				'<div class="input-group">'+
					'<input type="text" name="discount_arr[]" id="discount_arr" class="discount_multi form-control mousetrap numeric" placeholder="Discount" onkeyup="numeric(this)">'+
					'<span class="input-group-addon">%</span>'+
				'</div>'+
				'<select name="satuan_arr[]" class="satuan_multi mousetrap form-control">'+
					satuan
				'</select>';
		}
	  input_content += '</div>';
	  if(direction != "edit"){
	  	$('#preview_zone').prepend(input_content);
	  }else{
	  	$('#preview_zone').html(input_content);
	  }
	  window.URL.revokeObjectURL(fileList[a]);
	  $("#counter").val(new_counter);
	}
 	if(direction != "edit"){
		check_element();
		$("#elements").prepend("<input type='file' name='image[]' onchange='preview(this,\""+direction+"\")' multiple>");
		input.style.display = "none";
	}
}


function send_note(proses_page,id_session){
	var conf = JSON.parse("{"+$("#config").val()+"}");
	$.ajax({
		url		: proses_page,
		type	: "POST",
		data 	: {"direction":"send_notification","id_session":id_session},
		success : function(response){
			//$("#div_msg").html("<div style='padding:10px'>"+response+"</div>");	
			self.location.href = conf.dirhost+"/?page=input_produk&msg=1";
		}
	})
}
