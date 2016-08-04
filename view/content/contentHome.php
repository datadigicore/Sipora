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
        <div class="box">
          <div class="box-header with-border">
          <div id="chartDonut"></div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading" style="background-color:#2B91CF;color:white;">
              <h3 class="panel-title">Rekapitulasi Data Hasil Pelaporan <?php echo $gettriwulan->thang;echo " ".$gettriwulan->nama; ?></h3>
            </div>
            <div class="panel-group" id="accordion" style="padding:16px">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <a class="panel-title">
                    <h5 data-toggle="collapse" data-parent="#accordion" href="#collapse1" style="padding:0;margin:0">
                    Sudah Lapor <?php echo $gettriwulan->nama; ?></h5>
                  </a>
                </div>
                <div id="collapse1" class="panel-collapse collapse in">
                  <div class="box-body">
                  <table id="table-sudah" class="display nowrap table table-bordered table-striped" cellspacing="0" width="100%">
                    <thead style="background-color:#2B91CF;color:white;">
                      <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Deputi</th>
                        <th>Persentase</th>
                      </tr>
                    </thead>
                  </table>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <a class="panel-title">
                    <h5 data-toggle="collapse" data-parent="#accordion" href="#collapse2" style="padding:0;margin:0">
                    Belum Lapor <?php echo $gettriwulan->nama; ?></h5>
                  </a>
                </div>
                <div id="collapse2" class="panel-collapse collapse">
                  <table id="table-belum" class="display nowrap table table-bordered table-striped" cellspacing="0" width="100%">
                    <thead style="background-color:#2B91CF;color:white;">
                      <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Deputi</th>
                        <th>Persentase</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div> 
          </div>
        </div>
      </section>
    </div>
  </section>
</div>
<script src="<?php echo $base_url ?>static/plugins/highcharts/js/highcharts.js"></script>
<script src="<?php echo $base_url ?>static/plugins/highcharts/js/modules/exporting.js"></script>
<script type="text/javascript">
  $(function () {
    $(document).ready(function () {
      var tablesudah = $("#table-sudah").DataTable({
        "info":true,
        "oLanguage": {
          "sInfoFiltered": ""
        },
        "processing": true,
        "serverSide": true,
        "scrollX": true,
        "ajax": {
          "url": "<?php echo $base_process;?>triwulan/tablesudah",
          "type": "POST",
          "data": {id:<?php echo $gettriwulan->id; ?>,thang:<?php echo $gettriwulan->thang; ?>}
        },
        "columnDefs" : [
          {"targets": 0,
           "searchable": false,
           "orderable": false},
        ],
        "order": [ 1, "asc" ]
      });
      tablesudah.on( 'order.dt search.dt draw.dt', function () {
        tablesudah.column(0, {search:'applied', order:'applied', draw:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
        });
      }).draw();
      var tablebelum = $("#table-belum").DataTable({
        "info":true,
        "oLanguage": {
          "sInfoFiltered": ""
        },
        "processing": true,
        "serverSide": true,
        "scrollX": true,
        "ajax": {
          "url": "<?php echo $base_process;?>triwulan/tablebelum",
          "type": "POST",
          "data": {id:<?php echo $gettriwulan->id; ?>,thang:<?php echo $gettriwulan->thang; ?>}
        },
        "columnDefs" : [
          {"targets": 0,
           "searchable": false,
           "orderable": false},
        ],
        "order": [ 1, "asc" ]
      });
      tablebelum.on( 'order.dt search.dt draw.dt', function () {
        tablebelum.column(0, {search:'applied', order:'applied', draw:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
        });
      }).draw();
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