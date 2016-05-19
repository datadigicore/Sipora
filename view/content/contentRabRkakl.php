<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Data Rencana Kegiatan
      <small>Menu</small>
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-table"></i> <b>Data Kegiatan</b></li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title" style="margin-top:6px;">Tabel Rencana Kegiatan</h3>
          </div>
          <div class="box-body">
            <?php include "view/include/contentAlert.php" ?>
            <div class="row">
              <div class="col-md-6">
                <table class="display table table-bordered table-striped">
                  <tr>
                    <td><label>Tahun</label></td>
                    <td>
                      <select class="form-control select2" name="tahun2" id="tahun2" required>
                        <?php $rab->getYear(); ?>
                      </select>
                    </td>
                  </tr>
                  <?php if ($_SESSION['kdgrup'] == "") { ?>
                  <tr>
                    <td><label>Deputi</label></td>
                      <td>
                        <select id="direktorat2" name="direktorat2" class="form-control" onchange="search()">
                          <option value="">Semua Deputi</option>
                          <?php $rab->kdkegiatan(); ?>
                        </select>
                      </td>
                  </tr>
                  <?php } else{ ?>
                  <tr>
                    <td><label>Deputi</label></td>
                    <td>
                      <select id="direktorat2" name="direktorat2" class="form-control" onchange="search()">
                        <?php echo $rab->kdkegiatanbyGrup();?>
                        <option value="">Semua Deputi</option>
                      </select>
                    </td>
                  </tr>
                  <?php } ?>
                </table>
              </div>
            </div>
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
                  <th width="10%">Persentase Realisasi</th>
                  <th width="10%">Volume</th>
                  <th width="10%">Persentase Volume</th>
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
<div class="modal fade" id="mdl-vol">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo $url_rewrite;?>process/kegiatan/editvol" method="POST">
        <div class="modal-header" style="background-color:#2B91CF !important; color:white;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color:white">×</span></button>
          <h4 class="modal-title">Dialog Box</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" id="idrkakl_vol" name="idrkakl_vol" value="" />
          <input type="hidden" id="id_volume" name="id_volume" value="" />
          <div class="form-group">
            <label>Volume Kegiatan</label>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-8">
                <label>Target Volume</label>
                <input type="text" class="form-control nomor" id="vol_target" name="vol_target" placeholder="Target Volume" required />
              </div>
              <div class="col-md-4">
                <label>Satuan</label>
                <input type="text" class="form-control" id="satuan" name="satuan" onchange="inputrute(this.id,this.value)" placeholder="Satuan" required oncha/>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-8">
                <label>Realisasi Volume</label>
                <input type="text" class="form-control nomor" id="vol_real" name="vol_real" placeholder="Realisasi Volume" required />
              </div>
              <div class="col-md-4">
                <label>Satuan Kegiatan</label>
                <input type="text" readonly class="form-control" id="satuan2" placeholder="Satuan" />
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" data-dismiss="modal" class="btn btn-flat btn-warning">Tidak</button>
          <button type="submit" class="btn btn-flat btn-success">Ya</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="unlock">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo $url_rewrite;?>process/kegiatan/lockkomp" method="POST">
        <div class="modal-header" style="background-color:#2B91CF !important; color:white;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color:white">×</span></button>
          <h4 class="modal-title">Dialog Box</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" id="statuslock" name="statuslock" value="4" />
          <input type="hidden" id="idrkakl_unlock" name="idrkakl" />
          <div class="form-group">
            <label>Apakah Anda Yakin Ingin Melakukan Unlock Data ?</label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" data-dismiss="modal" class="btn btn-flat btn-warning">Tidak</button>
          <button type="submit" class="btn btn-flat btn-success">Ya</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="lock">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo $url_rewrite;?>process/kegiatan/lockkomp" method="POST">
        <div class="modal-header" style="background-color:#2B91CF !important; color:white;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color:white">×</span></button>
          <h4 class="modal-title">Dialog Box</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" id="statuslock" name="statuslock" value="0" />
          <input type="hidden" id="idrkakl_lock" name="idrkakl" />
          <div class="form-group">
            <label>Apakah Anda Yakin Ingin Melakukan Lock Data ?</label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" data-dismiss="modal" class="btn btn-flat btn-warning">Tidak</button>
          <button type="submit" class="btn btn-flat btn-success">Ya</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
var table;
  $(document).ready(function() {
    var tahun = $('#tahun2').val();
    var direktorat = $('#direktorat2').val();
    table = $("#table").DataTable({
      "info":true,
        "oLanguage": {
          "sInfoFiltered": ""
        },
        "processing": true,
        "serverSide": true,
        "scrollX": true,
        "ajax": {
          "url": "<?php echo $url_rewrite;?>process/kegiatan/table-rkakl",
          "type": "POST",
          "data": { 'tahun' : tahun,
                    'direktorat' : direktorat }
        },
        <?php if ($_SESSION['direktorat'] == "") { ?>
          "columnDefs" : [
            {"targets" : 0,
             "visible" : false},
            {"targets" : 1},
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
                  '<tr class="group" style="background-color:#FFDD77;"><td colspan="12">'+group+'</td></tr>'
                );
              last = group;
              }
            });
          },
        <?php }else{?>
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
            api.column(2, {page:'current'} ).data().each( function ( group, i ) {
              if ( last !== group ) {
                $(rows).eq( i ).before(
                  '<tr class="group" style="background-color:#FFDD77;"><td colspan="12">'+group+'</td></tr>'
                );
              last = group;
              }
            });
          },
        <?php } ?>
        "order": [[ 0, "asc" ], [ 1, "asc" ], [ 2, "asc" ], [ 3, "asc" ], [ 4, "asc" ], [ 5, "asc" ]]
    });
  });
  $(function () {
    
    $(document).on("click", "#btn-vol", function (){
      var tr = $(this).closest('tr');
      tabrow = table.row(tr);
      idrkakl_vol =tabrow.data()[0]; 
      satuan =tabrow.data()[13]; 
      id_volume =tabrow.data()[14]; 
      vol_target =tabrow.data()[15]; 
      vol_real =tabrow.data()[16]; 
      $("#idrkakl_vol").val(idrkakl_vol);
      $("#vol_target").val(vol_target);
      $("#vol_real").val(vol_real);
      $("#satuan").val(satuan);
      $("#satuan2").val(satuan);
      $("#id_volume").val(id_volume);
    });

    $(document).on("click", "#btn-lock", function (){
      var tr = $(this).closest('tr');
      tabrow = table.row(tr);
      $("#idrkakl_lock").val(tabrow.data()[0]);
    });
    $(document).on("click", "#btn-unlock", function (){
      var tr = $(this).closest('tr');
      tabrow = table.row(tr);
      $("#idrkakl_unlock").val(tabrow.data()[0]);
    });
  });
  
  function search(){
    var tahun = $('#tahun2').val();
    var direktorat = $('#direktorat2').val();
    table.destroy();
    table = $("#table").DataTable({
      "info":true,
        "oLanguage": {
          "sInfoFiltered": ""
        },
        "processing": true,
        "serverSide": true,
        "scrollX": true,
        "ajax": {
          "url": "<?php echo $url_rewrite;?>process/kegiatan/table-rkakl",
          "type": "POST",
          "data": { 'tahun' : tahun,
                    'direktorat' : direktorat }
        },
        <?php if ($_SESSION['direktorat'] == "") { ?>
          "columnDefs" : [
            {"targets" : 0,
             "visible" : false},
            {"targets" : 1},
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
                  '<tr class="group" style="background-color:#FFDD77;"><td colspan="12">'+group+'</td></tr>'
                );
              last = group;
              }
            });
          },
        <?php }else{?>
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
            api.column(2, {page:'current'} ).data().each( function ( group, i ) {
              if ( last !== group ) {
                $(rows).eq( i ).before(
                  '<tr class="group" style="background-color:#FFDD77;"><td colspan="12">'+group+'</td></tr>'
                );
              last = group;
              }
            });
          },
        <?php } ?>
        "order": [[ 0, "asc" ], [ 1, "asc" ], [ 2, "asc" ], [ 3, "asc" ], [ 4, "asc" ], [ 5, "asc" ]]
    });
  }


  function inputrute(id,val){
    var satuan = $('#satuan').val();
    $('#satuan2').val(satuan);
  }
</script>
