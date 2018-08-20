
$(function(){
	$("#source").on("change",function(){
		src = $(this).val();
		if(src == "unggah"){
			$(".fupload").slideDown();
			$("#youtube, #link").val("");
			$(".fyoutube, .flink").slideUp();
		}
		if(src == "youtube"){
			$(".fyoutube").slideDown();
			$("#image, #link").val("");
			$(".fupload, .flink").slideUp();
		}
		if(src == "link"){
			$(".flink").slideDown();
			$("#image, #youtube").val("");
			$(".fupload, .fyoutube").slideUp();
		}
	})
})

function removal(id){
	if(confirm("Anda yakin menghapus Slideshow ini?")){
			proses_page = $("#proses_page").val();
			$.ajax({
				url		: proses_page,
				type	: "POST",
				data 	: {"direction":"delete","no":id},
				success	: function(response){
					$("#tr_"+id).fadeOut(500);	
				}
			})
	}
	
}
