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
                  <div id="chartDonut"></div>
                </div>
                <div role="tabpanel" class="tab-pane" id="triwulan2">2</div>
                <div role="tabpanel" class="tab-pane" id="triwulan3">3</div>
                <div role="tabpanel" class="tab-pane" id="triwulan4">4</div>
              </div>
            </div>
          </div>
        </div>
      </div> <!-- end of row -->

    </div> <!-- end of main class -->
    <div class="footer">Powered By BBSDM Team : <b><a href='<?php echo $base_content ?>'>Susunan Redaksi</a></b> </div>
  </div><!-- end of container -->


  <!-- dummy chart js javascript -->
  <script>
    var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
    var ChartData = {
      labels : ["January","February","March","April","May","June","July"],
      datasets : [
        {
          label: "My First dataset",
          fillColor : "rgba(220,220,220,0.2)",
          strokeColor : "rgba(220,220,220,1)",
          pointColor : "rgba(220,220,220,1)",
          pointStrokeColor : "#fff",
          pointHighlightFill : "#fff",
          pointHighlightStroke : "rgba(220,220,220,1)",
          data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
        },
        {
          label: "My Second dataset",
          fillColor : "rgba(151,187,205,0.2)",
          strokeColor : "rgba(151,187,205,1)",
          pointColor : "rgba(151,187,205,1)",
          pointStrokeColor : "#fff",
          pointHighlightFill : "#fff",
          pointHighlightStroke : "rgba(151,187,205,1)",
          data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
        }
      ]
    }
  window.onload = function(){
    var ctx1 = document.getElementById("canvas1").getContext("2d");
    window.myLine = new Chart(ctx1).Line(ChartData, {
      responsive: true
    });
    var ctx2 = document.getElementById("canvas2").getContext("2d");
    window.myBar = new Chart(ctx2).Bar(ChartData, {
      responsive : true
    });
  }
  </script>
  <script src="<?php echo $base_url ?>static/plugins/highcharts/js/highcharts.js"></script>
<script src="<?php echo $base_url ?>static/plugins/highcharts/js/modules/exporting.js"></script>
<script type="text/javascript">
  $(function () {
    $(document).ready(function () {
      $.ajax({
        type: "post",
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
</body>
</html>