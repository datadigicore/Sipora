<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Data Kegiatan
      <small>Menu</small>
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-table"></i> <b>Data Kegiatan</b></li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title" style="margin-top:6px;">Tabel Rencana Kegiatan</h3>
          </div>
          <div class="box-body">
            <?php include "view/include/contentAlert.php" ?>
            <table class="display table table-bordered table-striped" style="width:750px">
              <tr>
                <td><label>Tahun</label></td>
                <td>
                  <select class="form-control select2" name="tahun2" id="tahun2" required>
                    <?php $rab->getYear(); ?>
                  </select>
                </td>
              </tr>
              <?php if ($_SESSION['direktorat'] == "") { ?>
              <tr>
                <td><label>Direktorat</label></td>
                  <td>
                    <select id="direktorat2" name="direktorat2" class="form-control" onchange="search()">
                      <option value="">Semua Direktorat</option>
                      <?php $rab->kdkegiatan(); ?>
                    </select>
                  </td>
              </tr>
              <?php } else{ ?>
              <tr>
                <td><label>Direktorat</label></td>
                <td>
                  <label><?php echo $rab->kdkegiatanbyID($_SESSION['direktorat']);?></label>
                </td>
              </tr>
              <?php } ?>
            </table>
            <table id="table" class="display table table-bordered table-striped " cellspacing="0" width="100%">
              <thead style="background-color:#2B91CF;color:white;">
                <tr>
                  <th>No</th>
                  <th width="15%">Direktorat</th>
                  <th width="10%">Output</th>
                  <th width="10%">Suboutput</th>
                  <th width="10%">Komponen</th>
                  <th width="10%">Subkomponen</th>
                  <th width="10%">Jumlah Pagu</th>
                  <th width="10%">Realisasi</th>
                  <th width="10%">Usulan</th>
                  <th width="10%">Sisa Anggaran</th>
                  <th width="5%">Aksi</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script>
var table;

  $(function () {
     $( "#datepicker" ).datepicker({
        changeMonth: true,
        changeYear: true,
        format: 'dd/mm/yyyy'
      });

    var tahun = $('#tahun2').val();
    var direktorat = $('#direktorat2').val();
            
    table = $("#table").DataTable({
        "processing": true,
        "serverSide": true,
        "scrollX": true,
        "ajax": {
          "url": "<?php echo $base_process;?>kegiatan/table-rkakl",
          "type": "POST",
          "data": {'tahun':tahun,
                    'direktorat':direktorat }
        },
        <?php if ($_SESSION['direktorat'] == "") { ?>
          "columnDefs" : [
            {"targets" : 0,
              "visible" : false},
            {"targets" : 1,
              "visible" : false},
            {"targets" : 2},
            {"targets" : 3},
            {"targets" : 4},
            {"targets" : 5},
            {"targets" : 6},
          ],
          "drawCallback": function ( settings ) {
            var api  = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last = null;
            api.column(1, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group" style="background-color:#00FF80;"><td colspan="9">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
            } );
        },
        <?php }else{?>
          "columnDefs" : [
            {"targets" : 0,
              "visible" : false},
            {"targets" : 1,
              "visible" : false},
            {"targets" : 2,
              "visible" : false},
            {"targets" : 3},
            {"targets" : 4},
            {"targets" : 5},
            {"targets" : 6},
          ],
          "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(2, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group" style="background-color:#00FF80;"><td colspan="9">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
            } );
        },
        <?php } ?>
        "order": [[ 0, "desc" ]]        
    });
    
    $(document).on("click", "#btn-aju", function (){
      var tr = $(this).closest('tr');
      tabrow = table.row(tr);
      $("#id_rab_aju").val(tabrow.data()[0]);
    });
    $(document).on("click", "#btn-sah", function (){
      var tr = $(this).closest('tr');
      tabrow = table.row(tr);
      $("#id_rab_sah").val(tabrow.data()[0]);
    });
    $(document).on("click", "#btn-rev", function (){
      var tr = $(this).closest('tr');
      tabrow = table.row(tr);
      $("#id_rab_rev").val(tabrow.data()[0]);
    });
    $(document).on("click", "#btn-pesan", function (){
      var tr = $(this).closest('tr');
      tabrow = table.row(tr);
      $("#vpesan").val(tabrow.data()[12]);
    });
    $(document).on("click", "#btn-del", function (){
      var tr = $(this).closest('tr');
      tabrow = table.row(tr);
      $("#id_rab_del").val(tabrow.data()[0]);
    });
    chprog();
  });
  
  function search(){
    var tahun = $('#tahun2').val();
    var direktorat = $('#direktorat2').val();
    table.destroy();
    table = $("#table").DataTable({
        "processing": true,
        "serverSide": true,
        "scrollX": true,
        "ajax": {
          "url": "<?php echo $base_process;?>kegiatan/table-rkakl",
          "type": "POST",
          "data": {'tahun':tahun,
                    'direktorat':direktorat }
        },
        <?php if ($_SESSION['direktorat'] == "") { ?>
          "columnDefs" : [
            {"targets" : 0,
              "visible" : false},
            {"targets" : 1,
              "visible" : false},
            {"targets" : 2},
            {"targets" : 3},
            {"targets" : 4},
            {"targets" : 5},
            {"targets" : 6},
          ],
          "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(1, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group" style="background-color:#00FF80;"><td colspan="9">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
            } );
        },
        <?php }else{?>
          "columnDefs" : [
            {"targets" : 0,
              "visible" : false},
            {"targets" : 1,
              "visible" : false},
            {"targets" : 2,
              "visible" : false},
            {"targets" : 3},
            {"targets" : 4},
            {"targets" : 5},
            {"targets" : 6},
          ],
          "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(2, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group" style="background-color:#00FF80;"><td colspan="9">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
            } );
        },
        <?php } ?>
        "order": [[ 0, "desc" ]]        
    });
  }
</script>
