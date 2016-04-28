<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Data Prosentase
      <small>Management Control</small>
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-table"></i> Data Prosentase</li>
    </ol>
  </section>
  <section class="content">
    <div class="row" id="row">
      <div class="col-sm-10 col-sm-offset-1" id="tableprosentase">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title" style="margin-top:6px;">Tabel Prosentase</h3>
            <div class="pull-right">
            <select class="form-control" onchange="search()">
              <option value="all">-- Semua Tahun --</option>
              <?php $triwulan->cekTahunAnggaran();?>
            </select>
            </div>
          </div>
          <div class="box-body">
            <?php include "view/include/contentAlert.php" ?>
            <p style="margin-bottom:12px"><b>Keterangan Status : </b><br>
              <label class="label label-success">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label> : Baik,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <label class="label label-warning">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label> : Sedang,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <label class="label label-danger">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label> : Cukup,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </p>
            <table id="table" class="display nowrap table table-bordered table-striped" cellspacing="0" width="100%">
              <thead style="background-color:#2B91CF;color:white;">
                <tr>
                  <th>Id</th>
                  <th>No</th>
                  <th>Nama Triwulan</th>
                  <th>Tahun</th>
                  <th style="background-color:#449d44">Baik</th>
                  <th style="background-color:#ec971f">Sedang</th>
                  <th style="background-color:#c9302c">Cukup</th>
                  <th>Aksi</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
      <div id="hidden"></div>
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
    "ajax": {
      "url": "<?php echo $base_process;?>triwulan/tablepro",
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
      {"targets": 7},
    ],
    "order": [[ 2, "asc" ]]
  });
  table.on( 'order.dt search.dt draw.dt', function () {
    table.column(1, {search:'applied', order:'applied', draw:'applied'}).nodes().each( function (cell, i) {
      cell.innerHTML = i+1;
    });
  }).draw();
  $(document).on("click", "#btn-edt", function (){
    tr     = $(this).closest('tr');
    tabrow = table.row(tr);
    id     = tabrow.data()[0];
    trwln  = tabrow.data()[2];
    thang  = tabrow.data()[3];
    high   = tabrow.data()[4];
    med    = tabrow.data()[5];
    low    = tabrow.data()[6];
    $("#tableprosentase").switchClass( "col-sm-10", "col-sm-7", 1000, "easeInOutQuad" );
    window.setTimeout(function(){
      $("#hidden").html(`<div class="col-sm-3">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title" style="margin-top:6px;">Edit Prosentase</h3>
          </div>
          <div class="box-body">
            <form method="POST" action="<?php echo $base_process;?>triwulan/prosentase">
            <div class="row">
              <div class="col-md-12">
                <div class="box-body well form-horizontal">
                  <div class="form-group">
                    <div class="col-md-12">
                      <label>Tahun Anggaran</label>
                      <input type="hidden" class="form-control" name="id" value="`+id+`">
                      <input class="form-control" name="thang" value="`+thang+`" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label>Status Triwulan</label>
                      <input class="form-control" name="triwulan" value="`+trwln+`" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="label label-success">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>&nbsp;&nbsp;<label>Baik</label>
                      <input type="text" id="high" name="high" class="form-control nomor" value="`+high+`">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="label label-warning">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>&nbsp;&nbsp;<label>Sedang</label>
                      <input type="text" id="med" name="med" class="form-control nomor" value="`+med+`">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="label label-danger">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>&nbsp;&nbsp;<label>Cukup</label>
                      <input type="text" id="low" name="low" class="form-control nomor" value="`+low+`">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="box-footer">
                  <button type="submit" class="btn btn-success pull-right">Simpan Data</button>
                </div>
              </div>
            </div>
          </form>
          </div>
        </div>        
      </div>`);
    }, 750)
  });
  // var h, m, l;
  $(document).on("keyup", ".nomor", function(){
    $(this).mask('00');
  });
  // $(document).on("change", "#high", function(){
  //   h = $(this).val();
  //   if (h < 0) {
  //     alert("Data input tidak boleh minus");
  //     $(this).val(0);h=0;
  //   }
  //   else if (h <= m) {
  //     alert("Data input tidak boleh kurang dari prosentase baik");
  //     $(this).val(0);h=0;
  //   }
  //   else if (h <= l) {
  //     alert("Data input tidak boleh kurang dari prosentase cukup");
  //     $(this).val(0);h=0;
  //   }
  // });
  // $(document).on("change", "#med", function(){
  //   m = $(this).val();
  //   if (m < 0) {
  //     alert("Data input tidak boleh minus");
  //     $(this).val(0);m=0;
  //   }
  //   else if (m <= l) {
  //     alert("Data input tidak boleh kurang dari prosentase cukup");
  //     $(this).val(0);m=0;
  //   }
  //   else if (m >= h) {
  //     alert("Data input tidak boleh lebih dari prosentase baik");
  //     $(this).val(0);m=0;
  //     if (m <= l) {
  //       $("#low").val(0);l=0;
  //     }
  //   }
  // });
  // $(document).on("change", "#low", function(){
  //   l = $(this).val();
  //   if (l < 0) {
  //     alert("Data input tidak boleh minus");
  //     $(this).val(0);l=0;
  //   }
  //   else if (l >= m) {
  //     alert("Data input tidak boleh lebih dari prosentasi sedang");
  //     $(this).val(0);l=0;
  //   }
  //   else if (l >= h) {
  //     alert("Data input tidak boleh lebih dari prosentasi baik");
  //     $(this).val(0);l=0;
  //   }
  // });
</script>