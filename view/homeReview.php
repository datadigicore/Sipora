  <div class="container-fluid">
    <div class="main">        
      <div class="row">
        <div class="col-sm-12">
          <div class="content-box">
            <div class="content-box-header dark-green">
              Status Capaian Anggaran
            </div>
            <div class="content-box-body">
              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#triwulan1" aria-controls="triwulan1" role="tab" data-toggle="tab">Triwulan I</a></li>
                <li role="presentation"><a href="#triwulan2" aria-controls="triwulan2" role="tab" data-toggle="tab">Triwulan II</a></li>
                <li role="presentation"><a href="#triwulan3" aria-controls="triwulan3" role="tab" data-toggle="tab">Triwulan III</a></li>
                <li role="presentation"><a href="#triwulan4" aria-controls="triwulan4" role="tab" data-toggle="tab">Triwulan IV</a></li>
              </ul>
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="triwulan1">
                  <div id="chartDonut1"></div>
                </div>
                <div role="tabpanel" class="tab-pane" id="triwulan2">
                  <div id="chartDonut2"></div>
                </div>
                <div role="tabpanel" class="tab-pane" id="triwulan3">
                  <div id="chartDonut3"></div>
                </div>
                <div role="tabpanel" class="tab-pane" id="triwulan4">
                  <div id="chartDonut4"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> <!-- end of row -->

    </div> <!-- end of main class -->
    <div class="footer">Powered By BBSDM Team : <b><a href='<?php echo $base_content ?>'>Susunan Redaksi</a></b> </div>
  </div><!-- end of container -->
<script src="<?php echo $base_url ?>static/plugins/highcharts/js/highcharts.js"></script>
<script src="<?php echo $base_url ?>static/plugins/highcharts/js/modules/exporting.js"></script>
<script type="text/javascript">
  $(function () {
    $(document).ready(function () {
      $.ajax({
        type: "post",
        url : "<?php echo $base_process.'laporan/chart_all_column'; ?>",
        dataType: "json",
        success: function(result)
        {
          chartpie1.series[0].setData(result[0]);
          chartpie2.series[1].setData(result[1]);
          chartpie3.series[2].setData(result[2]);
          chartpie4.series[3].setData(result[3]);
        }
      });
      var today = new Date();
      var chartpie1 = new Highcharts.Chart({
        chart: {
            renderTo: 'chartDonut1',
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
            pointFormat: 'Realisasi Anggaran '+today.getFullYear()+': <b>{point.y:.3f} %</b>'
        },
        series: [{
            name: 'Total Anggaran',
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
        },{
            name: 'Rincian Anggaran',
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
      var chartpie2 = new Highcharts.Chart({
        chart: {
            renderTo: 'chartDonut2',
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
            pointFormat: 'Realisasi Anggaran '+today.getFullYear()+': <b>{point.y:.3f} %</b>'
        },
        series: [{
            name: 'Total Anggaran',
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
        },{
            name: 'Rincian Anggaran',
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
      var chartpie3 = new Highcharts.Chart({
        chart: {
            renderTo: 'chartDonut3',
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
            pointFormat: 'Realisasi Anggaran '+today.getFullYear()+': <b>{point.y:.3f} %</b>'
        },
        series: [{
            name: 'Total Anggaran',
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
        },{
            name: 'Rincian Anggaran',
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
      var chartpie4 = new Highcharts.Chart({
        chart: {
            renderTo: 'chartDonut4',
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
            pointFormat: 'Realisasi Anggaran '+today.getFullYear()+': <b>{point.y:.3f} %</b>'
        },
        series: [{
            name: 'Total Anggaran',
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
        },{
            name: 'Rincian Anggaran',
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
</body>
</html>