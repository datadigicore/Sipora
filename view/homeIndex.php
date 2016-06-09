  <div class="container-fluid">
    <div class="main">    
      <div class="row"> 
          <div class="col-sm-9">
            <div class="content-box">
              <div class="content-box-header dark-green">
                Berita Utama
              </div>
              <div class="content-box-body">
              <?php 
              foreach ($arrBerita[id] as $key => $value) { ?>
                
                <div class="row">
                  <article class="col-xs-12">
                    <div class="media">
                      <div class="media-body">
                        <h2 class="media-heading"><a href="#"><?php echo $arrBerita[judul][$key] ?></a></h2>
                        <p><?php echo $arrBerita[isi][$key] ?></p>            
                      <ul class="list-inline pull-right">
                        <li><a href="#">Selengkapnya</a></li>
                      </ul>
                      </div>
                    </div>
                  </article>
                </div>
                <hr>
                <?php
              }

              ?>
                

                
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="panel panel-default">
              <div class="content-box-header dark-green">
                Pengumuman
              </div>
              <div class="panel-body">
                <?php echo $arrPengumuman[isi][0] ?>
              </div>
            </div>
          </div>
                <div class="col-sm-12">
          <div class="content-box">
            <div class="content-box-header dark-green">
              Status Capaian Anggaran
            </div>
            <div class="content-box-body">
              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#triwulan1" onclick="chart1()" aria-controls="triwulan1" role="tab" data-toggle="tab">Triwulan I</a></li>
                <li role="presentation"><a href="#triwulan2" onclick="chart2()"  aria-controls="triwulan2" role="tab" data-toggle="tab">Triwulan II</a></li>
                <li role="presentation"><a href="#triwulan3" aria-controls="triwulan3" onclick="chart3()" role="tab" data-toggle="tab">Triwulan III</a></li>
                <li role="presentation"><a href="#triwulan4" aria-controls="triwulan4" onclick="chart4()" role="tab" data-toggle="tab">Triwulan IV</a></li>
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
      </div><!-- end of row -->
    </div><!-- end of main class -->
    <div class="footer">Powered By BBSDM Team : <b><a href='<?php echo $base_content ?>'>Susunan Redaksi</a></b></div>
  </div><!-- end of container -->
</body>
<script type="text/javascript">
  $(document).ready(function() {
    $('#calendar').fullCalendar({
      header: {
        left : '',
        center: 'title',
        right: 'prev,next'
      }
    })
  });
</script>
<style type="text/css">
  .fc h2 {
     font-size: 24px;
  }
</style>
<script type="text/javascript">
var chartpie1;
var chartpie2;
var chartpie3;
var chartpie4;
  $(function () {
    $(document).ready(function () {
      chart1();
    });
  });

  function chart1(){
    // chartpie2.destroy();
    $.ajax({
        type: "post",
        url : "<?php echo $base_process.'laporan/chart_all_column'; ?>",
        dataType: "json",
        success: function(result)
        {
            // alert(result);
          chartpie1.series[0].setData(result[0]);
        }
      });
      var today = new Date();
      chartpie1 = new Highcharts.Chart({
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
     
  }

  function chart2(){
    $.ajax({
        type: "post",
        url : "<?php echo $base_process.'laporan/chart_all_column'; ?>",
        dataType: "json",
        success: function(result)
        {
          chartpie2.series[1].setData(result[1]);
        }
      });
      var today = new Date();
      chartpie2 = new Highcharts.Chart({
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
     
  }

  function chart3(){
    $.ajax({
        type: "post",
        url : "<?php echo $base_process.'laporan/chart_all_column'; ?>",
        dataType: "json",
        success: function(result)
        {
          chartpie3.series[2].setData(result[2]);
        }
      });
      var today = new Date();
      chartpie3 = new Highcharts.Chart({
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
     
  }

  function chart4(){
    $.ajax({
        type: "post",
        url : "<?php echo $base_process.'laporan/chart_all_column'; ?>",
        dataType: "json",
        success: function(result)
        {
          chartpie4.series[3].setData(result[3]);
        }
      });
      var today = new Date();
      chartpie4 = new Highcharts.Chart({
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
     
  }
</script>
</html>