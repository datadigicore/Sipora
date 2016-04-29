<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Dashboard
      <small>Menu</small>
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-dashboard"></i> Dashboard</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <section class="col-sm-10 col-sm-offset-1 connectedSortable">
        <div id="chartDonut"></div>
      </section>
    </div>
  </section>
</div>
<script src="<?php echo $base_url ?>static/plugins/highcharts/js/highcharts.js"></script>
<script src="<?php echo $base_url ?>static/plugins/highcharts/js/modules/exporting.js"></script>
<script type="text/javascript">
  $(function () {
    $(document).ready(function () {
      $.ajax({
        type: "post",
        url : "<?php echo $base_process.'laporan/chart_column'; ?>",
        data : {id:<?php echo $_POST['data'] ?>},
        dataType: "json",
        success: function(result)
        {
          chartpie.series[0].setData(result);
        }
      });
      var today = new Date();
      var chartpie = new Highcharts.Chart({
        chart: {
            renderTo: 'chartDonut',
            type: 'column'
        },
        title: {
            text: 'Realisasi Anggaran Kegiatan <?php echo $_POST['data'] ?> per Triwulan'
        },
        subtitle: {
            text: 'Tahun Anggaran '+today.getFullYear()
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Realisasi'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Realisasi Anggaran '+today.getFullYear()+': <b>{point.y:.1f}</b>'
        },
        series: [{
            name: 'Rincian Anggaran',
            data: [
                ['Triwulan 1', 0],
                ['Triwulan 2', 0],
                ['Triwulan 3', 0],
                ['Triwulan 4', 0]
            ],
            dataLabels: {
                enabled: true,
                color: '#FFFFFF',
                format: '{point.y:.3f} %', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
      });
    });
  });
</script>