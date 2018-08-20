$(document).ready(function(){
	$(".registers").on("click",function(){
		data 		= $("#data_page").val();
		id_regist 	= $(this).val();
		if(id_regist != ""){
			$("#form_regist").html("<div style='text-align:center'><img src='files/images/loader.gif'></div>");
			$.ajax({
				url		: data,
				type	: "POST",
				data	: {"direction":"get_condition","id_regist":id_regist},
				success	: function(response){
					$("#form_regist").html(response);
				}
			})
		}else{
			$("#form_regist").html("");
		}
	})	
	 
})
