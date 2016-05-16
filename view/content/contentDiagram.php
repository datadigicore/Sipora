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
          chartpie.series[0].setData(result[0]);
          chartpie.series[1].setData(result[1]);
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
            pointFormat: 'Realisasi Anggaran '+today.getFullYear()+': <b>{point.y:.3f} %</b>'
        },
        series: [{
            name: 'Total Anggaran',
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
        },{
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
    // Load the fonts
    Highcharts.createElement('link', {
       href: 'https://fonts.googleapis.com/css?family=Signika:400,700',
       rel: 'stylesheet',
       type: 'text/css'
    }, null, document.getElementsByTagName('head')[0]);
    // Add the background image to the container
    Highcharts.wrap(Highcharts.Chart.prototype, 'getContainer', function (proceed) {
       proceed.call(this);
       this.container.style.background = '#FFFFFF';
    });
    Highcharts.theme = {
       colors: ["#f45b5b", "#8085e9", "#8d4654", "#7798BF", "#aaeeee", "#ff0066", "#eeaaee",
          "#55BF3B", "#DF5353", "#7798BF", "#aaeeee"],
       chart: {
          backgroundColor: null,
          style: {
             fontFamily: "Signika, serif"
          }
       },
       title: {
          style: {
             color: 'black',
             fontSize: '16px',
             fontWeight: 'bold'
          }
       },
       subtitle: {
          style: {
             color: 'black'
          }
       },
       tooltip: {
          borderWidth: 0
       },
       legend: {
          itemStyle: {
             fontWeight: 'bold',
             fontSize: '13px'
          }
       },
       xAxis: {
          labels: {
             style: {
                color: '#6e6e70'
             }
          }
       },
       yAxis: {
          labels: {
             style: {
                color: '#6e6e70'
             }
          }
       },
       plotOptions: {
          series: {
             shadow: true
          },
          candlestick: {
             lineColor: '#404048'
          },
          map: {
             shadow: false
          }
       },
       // Highstock specific
       navigator: {
          xAxis: {
             gridLineColor: '#D0D0D8'
          }
       },
       rangeSelector: {
          buttonTheme: {
             fill: 'white',
             stroke: '#C0C0C8',
             'stroke-width': 1,
             states: {
                select: {
                   fill: '#D0D0D8'
                }
             }
          }
       },
       scrollbar: {
          trackBorderColor: '#C0C0C8'
       },
       // General
       background2: '#E0E0E8'
    };
    // Apply the theme
    Highcharts.setOptions(Highcharts.theme);
  });
</script>