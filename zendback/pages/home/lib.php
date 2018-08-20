<?php defined('mainload') or die('Restricted Access'); ?>
    <!-- chart js -->
    <script src="<?php echo $web_btpl_dir; ?>js/chartjs/Chart.bundle.min.js"></script>
    <!-- bootstrap progress js -->
    <script src="<?php echo $web_btpl_dir; ?>js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="<?php echo $web_btpl_dir; ?>js/nicescroll/jquery.nicescroll.min.js"></script>


    <script>
		<?php $tahun = date('Y'); ?>
        function feth_data(periode,jumlah){
			switch(periode){
				case "harian":
					label = [];
					for(i = 1;i<31;i++){
						if(i.length == 1){ i = "0"+i; } 
						label.push(i);
					}
				break;
				case "bulanan":
					label = ["Jan", "Feb", "Mar", "Apr", "Mei", "Juni", "Juli", "Agust", "Sep", "Okt", "Nov", "Des"];
				break;
				case "tahunan":
					label = [];
					thn1 = $("#tahun").val();
					thn2 = $("#tahun2").val();
					for(i = thn1;i<=thn2;i++){
						label.push(i);
					}
				break;
				default:
					label = ["Jan", "Feb", "Mar", "Apr", "Mei", "Juni", "Juli", "Agust", "Sep", "Okt", "Nov", "Des"];
				break;	
			}
			var ctx = document.getElementById("canvas_dahs").getContext('2d');
			var myChart = new Chart(ctx, {
				type: 'line',
				data: {
					labels: label,
					datasets: [{
						label: '# Jumlah Kunjungan',
						data			: jumlah,
						backgroundColor	: 'rgba(255, 99, 132, 0.2)',
						borderColor		: 'rgba(255,99,132,1)',
						borderWidth		: 1
					}]
				},
				options: {
					scales: {
						yAxes: [{
							ticks: {
								beginAtZero:true
							}
						}]
					}
				}
			});
		}
		
		$(document).ready(function () {
			var data_page = $("#data_page").val();
			$.ajax({
				url 	: data_page,
				type	: "POST",
				data 	: {"direction":"fetch_data"},
				success : function(res){
					feth_data("bulanan",JSON.parse(res));
				}
			})
			$("#periode").on("change",function(){
				$(".periode_el").hide();
				$("#cap_thn_awal").empty();
				periode 	= $(this).val();
				switch(periode){
					case "harian":
						$("#div_bulan, #div_tahun").show();
					break;
					case "bulanan":
						$("#div_tahun").show();
					break;
					case "tahunan":
						$("#cap_thn_awal").html("Awal");
						$("#div_tahun, #div_tahun2").show();
					break;	
				}
			})
			$("#fetch_data").on("click",function(){
				periode 	= $("#periode").val();
				bln 		= $("#bulan").val();
				thn 		= $("#tahun").val();
				thn2 		= $("#tahun2").val();
				$.ajax({
					url 	: data_page,
					type	: "POST",
					data 	: {"direction":"fetch_data","periode":periode,"bln":bln,"thn":thn,"thn2":thn2},
					success : function(res){
						feth_data(periode,JSON.parse(res));
					}
				})
			})
        });
    </script>


    <script>
        NProgress.done();
    </script>
    <!-- /datepicker -->
