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
      <section class="col-lg-12 connectedSortable">
        <div id="chartDonut"></div>
      </section>
    </div>
  </section>
</div>
<script type="text/javascript">
  $(function () {
    $(document).ready(function () {
      $.ajax({
        type: "post",
        url : "<?php echo $base_url.'process/report/chart_pie'; ?>",
        dataType: "json",
        success: function(result)
        {
          chartpie.series[0].setData(result);
        }
      });
      var chartpie = new Highcharts.Chart({
        chart: {
          renderTo: 'chartDonut',
          plotBackgroundColor: null,
          plotBorderWidth: null,
          plotShadow: false,
          type: 'pie'
        },
        title: {
          text: 'Realisasi Dana Anggaran'
        },
        tooltip: {
          pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
          pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
            enabled: false
          },
            showInLegend: true
          }
        },
        series: [{
          name: 'Prosentase',
          colorByPoint: true,
          data: [{
            name: 'Dana Anggaran',
            y: 56.33
            }, {
              name: '5696',
              y: 24.03,
              sliced: true,
              selected: true
            }, {
              name: '5697',
              y: 10.38
            }, {
              name: '5698',
              y: 4.77
            }, {
              name: '5699',
              y: 0.91
            }, {
            name: '5670',
            y: 0.2
          }]
        }]
      });
    });
  });
</script>
<script src="<?php echo $base_url ?>static/plugins/highcharts/js/highcharts.js"></script>
<script src="<?php echo $base_url ?>static/plugins/highcharts/js/modules/exporting.js"></script>