$(document).ready(function(){		
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
		if(confirm("Dengan menghapus data satuan ini, data-data satuan produk yang di daftarkan sebelumnya, akan kehilangan relasi data nama satuannya, Anda yakin menghapus data Satuan Ini?")){
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
});

function removal(id){
	if(confirm("Dengan menghapus data satuan ini, data-data satuan produk yang di daftarkan sebelumnya, akan kehilangan relasi data nama satuannya, Anda yakin menghapus data Satuan Ini?")){
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

