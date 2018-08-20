$(document).ready(function(){
	$("#nmbank_dest").on("change",function(){
		$("#bank_info").html("<i class='fa fa-circle-o-notch fa-spin fa-fw'></i> Mengambil Data...");
		id_bank 	= $(this).val();	
		data_page	= $("#data_page").val();
		$.ajax({
			url  : data_page,
			type : "POST",
			data : {"direction":"get_info_bank","id_bank":id_bank},
			success: function(response){
				$("#bank_info").html(response);
			}
		});
	})
	
	$("#jml_bayar, #norek").on("keyup",function(e){
		if (/\D/g.test(this.value)) {
			this.value = this.value.replace(/\D/g, '');
		}
	});
	
})
