function removal(id){
	bootbox.confirm("Dengan menghapus data supplier ini, data-data pembelian yang sudah di daftarkan sebelumnya atas nama supplier ini, akan kehilangan relasi data supplier untuk data pembelian tersebut, Anda yakin menghapus data supplier Ini?",function(confirmed){
		if(confirmed == true){
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
	})
}
