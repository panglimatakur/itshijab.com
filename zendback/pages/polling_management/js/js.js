$(function(){
	$("#add_more").on("click",function(){
		var last_option 	= $(".option").length;
		var new_num_option	= +last_option + 1;
		html = 
		'<div class="input-group option" id="option_'+new_num_option+'" style="margin-top:5px">'+
		'<input type="text" class="form-control" name="option[]" value="" placeholder=""/>'+
        	'<span class="input-group-addon" >'+
        		'<a href="javascript:void()" id="del_more" title="Hapus Pilihan"  data-info="'+new_num_option+'">'+
            		'<i class="fa fa-minus-square"></i>'+
        		'</a>'+
        '</span>'+
		'</div>';
		$("#option_"+last_option).after(html);
	})
	$("#del_more").on("click",function(){
		var this_id 	= $(this).attr("data-info");
		$("#option_"+this_id).remove();
	})
	$("#del_db").on("click",function(){
		if(confirm("Anda yakin menghapus pilihan ini ?")){
			proses_page = $("#proses_page").val();
			var this_id 	= JSON.parse("{"+$(this).attr("data-info")+"}");
			var id_option 	= this_id.id_option;
			alert(this_id.id_element);
			
			$.ajax({
				url	 	: proses_page,
				type	: "POST",
				data 	: {"direction":"delete_option","id_option":id_option},
				success	: function(response){
					$("#option_"+this_id.id_element).remove();	
				}
			})
		}
	})
})	
function removal(id){
	if(confirm("Anda yakin menghapus polling ini ?")){
		proses_page = $("#proses_page").val();
		$.ajax({
			url	 	: proses_page,
			type	: "POST",
			data 	: {"direction":"delete","id_polling":id},
			success	: function(response){
				$("#tr_"+id).fadeOut(500);	
			}
		})
	}
	
}
