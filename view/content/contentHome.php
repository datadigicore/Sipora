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
        url : "<?php echo $base_process.'laporan/chart_pie'; ?>",
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
          text: 'Prosentase Total Dana Anggaran'
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
          },
          series: {
                cursor: 'pointer',
                point: {
                    events: {
                        click: function () {
                            var label = this.name;
                            var newlabel = label.replace('Kode Kegiatan ',''); 
                            // alert('Category: ' + newlabel + ', value: ' + this.y);
                            var f = document.createElement('form');
                            f.setAttribute('method','post');
                            f.setAttribute('action','diagram');
                            var i = document.createElement('input');
                            i.setAttribute('type','hidden');
                            i.setAttribute('name','data');
                            i.setAttribute('value',newlabel);
                            f.appendChild(i);
                            document.body.appendChild(f);
                            f.submit();
                        }
                    }
                }
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