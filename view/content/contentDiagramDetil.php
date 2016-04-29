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
        // url : "<?php echo $base_process.'laporan/chart_column'; ?>",
        // data : {id:<?php echo $_POST['data'] ?>},
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
            text: 'Monthly Average Rainfall'
        },
        subtitle: {
            text: 'Source: WorldClimate.com'
        },
        xAxis: {
            categories: [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dec'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Rainfall (mm)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Tokyo',
            data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

        }, {
            name: 'New York',
            data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

        }, {
            name: 'London',
            data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

        }, {
            name: 'Berlin',
            data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

        }]
      });
    });
  });
</script>