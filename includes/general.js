function numeric(txb) {
   txb.value = txb.value.replace(/[^0-9]/g,'');
}
$(function(){
	$("#btn_newsletter").on("click",function(){
		var conf = JSON.parse("{"+$("#config").val()+"}");
		var email_newsletter	= $("#email_newsletter").val();
		if(email_newsletter != ""){
			$.ajax({
				url 	: conf.dirhost+"/pages/beranda/ajax/proses.php",
				type 	: "POST",
				data 	: {"direction":"send_newsletter","email_newsletter":email_newsletter},
				success: function(){
					alert("Terimakasih, Alamat email anda berhasil disimpan ke database kami");	
				}
			});
		}
	})
	$(".numeric").on("keyup",function(e){
		if (/\D/g.test(this.value)) {
			this.value = this.value.replace(/\D/g, '');
		}
	});
	
})

function pick_poll(id_option,id_polling){
	var conf = JSON.parse("{"+$("#config").val()+"}");
	if(id_option != "" && id_polling != ""){
		$.ajax({
			url 	: conf.dirhost+"/pages/beranda/ajax/proses.php",
			type 	: "POST",
			data 	: {"direction":"send_polling","id_polling":id_polling,"id_option":id_option},
			success: function(response){
				if(response == "error"){
					alert("Untuk berpartisipasi dalam polling ini, silahkan Login terlebih dahulu atau daftarkan akun keanggotaan anda");
					location.href = conf.dirhost+"/?page=registration";	
				}
			}
		});
	}
}



