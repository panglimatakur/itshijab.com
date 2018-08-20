function getparent(id,target){
	config 		= JSON.parse('{'+$("#config").val()+'}');
	add 		= $("#parent_page").val();
	id_module 	= $("#link_"+id).attr("data-info");
	$("#id_module option[value='"+id_module+"']").attr('selected','selected'); 
	$("#"+target).html("<div style='text-align:center'><img src='"+config.dirhost+"/files/images/loader_v.gif'></div>");
	$.ajax({
		url 	: add,
		type 	: "POST",
		data 	: {"parent_id":id},
		success : function(response){
			$("#"+target).html(response);
		}
	})
	
}

function resetchild(){
	$("#divparent_id").html("");
	$("#newlink").html("");
}

function delete_link(id){
	if(confirm("Anda yakin menghapus Link Ini? Karena juga akan menghapus data link anak di bawahnya")){
		proses_page = $("#proses_page").val();
		$.ajax({
			url		: proses_page,
			type	: "POST",
			data 	: {"direction":"delete","no":id},
			success	: function(){
				$("#li_"+id).fadeOut(500);	
			}
		})
	}
}

function getcontenttype(add,target){
	ctype = $("#is_folder").val();
	if(ctype == 2){
		$.ajax({
			url  	: add,
			data 	: {"refresh":"true"},
			method	: "POST",
			success: function(response){
				$("#"+target).html(response);
			}
		})
	}
	else{
		$("#divctype").empty();
	}
}

