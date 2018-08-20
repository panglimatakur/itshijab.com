$(document).ready(function(){	
	$("#id_client_user_level").on("change",function(){
		treeview_check_page	= $("#treeview_check_page").val();
		data_page 			= $("#modules_page").val();
		id_client_user_level= $(this).val();
		if(id_client_user_level != ""){
			$("#div_modules").html("<div style='text-align:center'><img src='../../../files/images/loader_v.gif'></div>");
			$.ajax({
				url 	: data_page,
				type	: "POST",
				data	: {"show":"modules","id_client_user_level":id_client_user_level},
				success : function(response){
					var conf 			= JSON.parse("{"+$("#config").val()+"}");
					$("#div_modules").html(response);
					$('#tree2').checkboxTree({
						collapseImage: conf.dirhost+'/'+treeview_check_page+'/images/bminus.png',
						expandImage: conf.dirhost+'/'+treeview_check_page+'/images/bplus.png'
						
					});
				}
			})
		}else{
			alert("Pengisian Form Belum Lengkap?");
			$("#id_client_user_level").val("");
		}
	})
})

