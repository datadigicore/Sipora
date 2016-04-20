<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Data Triwulan
      <small>Management Control</small>
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-table"></i> Data Triwulan</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-sm-3 col-sm-offset-1">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title" style="margin-top:6px;">Tambah Triwulan</h3>
          </div>
          <div class="box-body">
            <form method="POST" action="<?php echo $base_process;?>triwulan/add">
            <div class="row">
              <div class="col-md-12">
                <div class="box-body well form-horizontal">
                  <div class="form-group">
                    <div class="col-md-12">
                      <label>Tahun Anggaran</label>
                      <select class="form-control" name="thang" required>
                        <option  value="" disabled selected>-- Pilih Tahun Anggaran --</option>
                        <?php $triwulan->cekTahunAnggaran();?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="box-footer">
                  <button type="submit" class="btn btn-success pull-right">Tambah Data</button>
                </div>
              </div>
            </div>
          </form>
          </div>
        </div>        
      </div>
      <div class="col-sm-7">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title" style="margin-top:6px;">Tabel Triwulan</h3>
            <div class="pull-right">
            <select class="form-control" onchange="search()">
              <option value="all">-- Semua Tahun --</option>
              <?php $triwulan->cekTahunAnggaran();?>
            </select>
            </div>
          </div>
          <div class="box-body">
            <?php include "view/include/contentAlert.php" ?>
            <table id="table" class="display nowrap table table-bordered table-striped" cellspacing="0" width="100%">
              <thead style="background-color:#2B91CF;color:white;">
                <tr>
                  <th>Id</th>
                  <th>No</th>
                  <th>Nama Triwulan</th>
                  <th>Tanggal Awal</th>
                  <th>Tanggal Akhir</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script type="text/javascript">
  var table = $("#table").DataTable({
    "oLanguage": {
      "sInfoFiltered": ""
    },
    "processing": true,
    "serverSide": true,
    "scrollX": true,
    "ajax": {
      "url": "<?php echo $base_process;?>triwulan/table",
      "type": "POST"
    },
    "columnDefs" : [
      {"targets": 0,
       "visible": false},
      {"targets": 1,
       "data"   : null,
       "searchable": false,
       "orderable": false},
      {"targets": 2},
      {"targets": 3},
      {"targets": 4},
      {"targets": 5},
      {"targets": 6},
    ],
    "order": [[ 2, "asc" ]]
  });
  table.on( 'order.dt search.dt draw.dt', function () {
    table.column(1, {search:'applied', order:'applied', draw:'applied'}).nodes().each( function (cell, i) {
      cell.innerHTML = i+1;
    });
  }).draw();
  $(document).on("click", "#btn-non", function (){
    var tr = $(this).closest('tr');
    tabrow = table.row( tr );
    id = tabrow.data()[0];
    $.ajax({
      type: "post",
      url : "<?php echo $base_process;?>triwulan/nonaktif",
      data: {id:id},
      success: function(data) {
        table.draw();
      }
    });
  });
  $(document).on("click", "#btn-act", function (){
    var tr = $(this).closest('tr');
    tabrow = table.row( tr );
    id = tabrow.data()[0];
    $.ajax({
      type: "post",
      url : "<?php echo $base_process;?>triwulan/aktifkan",
      data: {id:id},
      success: function(data) {
        table.draw();
      }
    });
  });
</script>