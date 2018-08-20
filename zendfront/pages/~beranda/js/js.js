config  = JSON.parse('{'+$("#config").val()+'}');
dirhost = config.dirhost;
page 	= config.page;
$(document).ready(function(){
	$(".del_katalog").on("click",function(){
		id_item = $(this).attr("data-id");
		bootbox.confirm("Mba pita, yakin ngapusin produknya yang ini niiii??",function(confirmed){
			if(confirmed == true){
				$.ajax({
					url : dirhost+"/zendfront/pages/"+page+"/ajax/proses.php",
					type: "POST",
					data: {"direction":"delete","id_item":id_item},
					success: function(response){
						$("#product_"+id_item).fadeOut();
					}
				})
			}
		})
	})
})