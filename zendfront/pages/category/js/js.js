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
						$("#tr_"+id_item).fadeOut();
					}
				})
			}
		})
	})
})
function lastPostFunc(){ 
	data_page = $("#data_page").val();
	$('div#lastPostsLoader').html('<div style="text-align:center;margin:10px"><img src="files/images/loader_v.gif"><br>Mengambil Data...</div>');
	var conf 	= JSON.parse("{"+$("#config").val()+"}");
	page		= conf.page;
	lastId		= $(".wrdLatest:last").attr("data-info");
	id_kategori = $("#id_kategori").val();
	$.ajax({
		url 	: data_page,
		type	: "POST",
		data	: {"page":page,"lastID":lastId,"id_kategori":id_kategori,"direction":"list_report"},
		success : function(data){
			if (data != "") {
				$(".wrdLatest:last").after(data)				
			}
			$('div#lastPostsLoader').empty();
		}
	});
};  
