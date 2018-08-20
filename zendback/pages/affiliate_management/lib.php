    <!-- echart -->
    <script src="<?php echo $web_btpl_dir; ?>js/echart/echarts-all.js"></script>
    <script src="<?php echo $web_btpl_dir; ?>js/echart/green.js"></script>
    <?php $value_kunjungan = "2.0, 4.9, 7.0, 23.2, 25.6, 76.7, 135.6, 162.2, 32.6, 20.0, 6.4, 3.3"; ?>
    <?php $value_pembeli = "2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6, 182.2, 48.7, 18.8, 6.0, 2.3"; ?>
    <?php
	$a = 0;
	while($a<12){ $a++;
		echo sprintf("%02d",$a);
	}
	?>
	<script>
        var myChart9 = echarts.init(document.getElementById('mainb'), theme);
        myChart9.setOption({
            title: {
                x: 'center',
                y: 'top',
                padding: [0, 0, 20, 0],
                text: 'Statistik Aktivitas Pengunjung dan Pembeli Anda',
                textStyle: {
                    fontSize: 15,
                    fontWeight: 'normal'
                }
            },
            tooltip: {
                trigger: 'axis'
            },
            toolbox: {
                show: true,
                feature: {
                    dataView: {
                        show: true,
                        readOnly: false
                    },
                    restore: {
                        show: true
                    },
                    saveAsImage: {
                        show: true
                    }
                }
            },
            calculable: true,
            legend: {
                data: ['Kunjungan', 'Pembelian'],
                y	: 'bottom'
            },
            xAxis: [
                {
                    type: 'category',
                    data: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            }
        ],
            yAxis: [
                {
                    type: 'value',
                    name: 'Jumlah',
                    axisLabel: {
                        formatter: '{value} Orang'
                    }
            }
        ],
            series: [
                {
                    name: 'Kunjungan',
                    type: 'bar',
                    data: [<?php echo $value_kunjungan; ?>]
            },
                {
                    name: 'Pembelian',
                    type: 'bar',
                    data: [<?php echo $value_pembeli; ?>]
            }
        ]
        });
    </script>
