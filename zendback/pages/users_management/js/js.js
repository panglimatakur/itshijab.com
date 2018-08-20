$(document).ready(function(){		
	$('#del_pic').on('click',function(){
		if(confirm("Anda yakin menghapus foto ini ?")){
			proses_page = $("#proses_page").val();
			id_user 	= $(this).attr("data-info");
			$("#div_loader_img").html("Menghapus Foto<br><img src='files/images/loader_v.gif' style='margin:5px 0 10px 0'><br>");
			$.ajax({
				url		: proses_page,
				type	: "POST",
				data	: {"direction":"del_pic","no":id_user},
				success	: function(response){
					$("#photo_container").empty();
				}
			})
		}
	})
	
});

function removal(id){
	if(confirm("Dengan menghapus data kontibutor ini, maka data-data tulisan yang sudah di daftarkan sebelumnya atas nama kontributor ini, akan kehilangan relasi data, Anda yakin menghapus data kontributor ini?")){
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

