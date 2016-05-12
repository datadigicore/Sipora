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
      <div class="col-xs-10 col-sm-offset-1">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title" style="margin-top:6px;">Table Kegiatan</h3>

            <?php if ($_SESSION['level'] != '0') {
              echo '<a id="tbl-tambah" href="'.$url_rewrite.'content/kegiatan-tambah/'.$idrkakl.'" class="btn btn-flat btn-success btn-md pull-right"><i class="fa fa-plus"></i>&nbsp;Tambah Kegiatan Baru</a>';
            }?>

          </div>
          <div class="box-body">
            <?php include "view/include/contentAlert.php" ?>
            <table class="display table table-bordered table-striped">
              <tr>
                <th><label>Info</label></th>
              <tr>
                <td valign="top" class="col-md-1">
                  <table class="table-striped col-md-12">
                      <?php $rab->getinfo($idrkakl); ?>
                  </table>
                </td>
            </table>
            <table id="table" class="display table table-bordered table-striped " cellspacing="0" width="100%">
              <thead style="background-color:#2B91CF;color:white;">
                <tr>
                  <th>No</th>
                  <th width="15%">Uraian Acara</th>
                  <th width="18%">Tanggal</th>
                  <th width="10%">Lokasi</th>
                  <th width="10%">Jumlah</th>
                  <th width="10%">Status</th>
                  <th width="15%">Action</th>
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
<!-- <div class="modal fade" id="addrab">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo $url_rewrite;?>process/rab/save" method="POST" enctype="multipart/form-data">
        <div class="modal-header" style="background-color:#2B91CF !important; color:white;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color:white">×</span></button>
          <h4 class="modal-title">Add RAB</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Tahun Anggaran</label>
            <select class="form-control" name="tahun" id="tahun" required>
              <?php for ($i=0; $i < count($tahun); $i++) { 
                echo "<option value='".$tahun[$i]."'>".$tahun[$i].'</option>';
              }?>
            </select>
          </div>
          <input type="hidden" id="prog" name="prog" value="06" />
          <?php if ($_SESSION['direktorat'] == "") { ?>
          <div class="form-group">
            <label>Kode Kegiatan</label>
            <select class="form-control" id="direktorat" name="direktorat" onchange="chout()">
                <option value="5696">5696</option>
                <option value="5697">5697</option>
                <option value="5698">5698</option>
                <option value="5699">5699</option>
                <option value="5700">5700</option>
            </select>
          </div>
          <?php } else{ ?>
          <input type="hidden" id="direktorat" name="direktorat" value="<?php echo $_SESSION['direktorat']; ?>" />
          <?php } ?>
          <div class="form-group">
            <label>Output</label>
            <select class="form-control" id="output" name="output" onchange="chout()" required>
              <option>-- Pilih Output --</option>
            </select>
          </div>
          <div class="form-group">
            <label>Suboutput</label>
            <select class="form-control" id="soutput" name="soutput" onchange="chsout()" required>
              <option>-- Pilih Sub Output --</option>
            </select>
          </div>
          <div class="form-group">
            <label>Komponen</label>
            <select class="form-control" id="komp" name="komp" onchange="chkomp()" required>
              <option>-- Pilih Komponen --</option>
            </select>
          </div>
          <div class="form-group">
            <label>Sub Komponen</label>
            <select class="form-control" id="skomp" name="skomp" onchange="chskomp()" required>
              <option>-- Pilih Sub Komponen --</option>
            </select>
          </div>
          <div class="form-group">
            <label>Uraian Acara</label>
            <textarea rows="5" type="text" class="form-control" id="uraian" name="uraian" placeholder="Uraian Acara" style="resize:none;" required></textarea>
          </div>
          <div class="form-group">
            <label>Tanggal</label>
            <input class="form-control" type="text" name="tanggal"  placeholder="dd/mm/yyyy" />
          </div>
          <div class="form-group">
            <label>Lokasi Kegiatan</label>
            <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Lokasi Kegiatan" required />
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-flat btn-success">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="ajuan">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo $url_rewrite;?>process/rab/ajukan" method="POST">
        <div class="modal-header" style="background-color:#2B91CF !important; color:white;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color:white">×</span></button>
          <h4 class="modal-title">Dialog Box</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" id="id_rab_aju" name="id_rab_aju" value="" />
          <div class="form-group">
            <label>Apakah Anda Yakin Ingin Melakukan Pengajuan ?</label>
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
<div class="modal fade" id="sahkan">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo $url_rewrite;?>process/rab/sahkan" method="POST">
        <div class="modal-header" style="background-color:#2B91CF !important; color:white;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color:white">×</span></button>
          <h4 class="modal-title">Dialog Box</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" id="id_rab_sah" name="id_rab_sah" value="" />
          <div class="form-group">
            <label>Apakah Anda Yakin Ingin Melakukan Pengesahan ?</label>
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
<div class="modal fade" id="revisi">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo $url_rewrite;?>process/rab/revisi" method="POST">
        <div class="modal-header" style="background-color:#2B91CF !important; color:white;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color:white">×</span></button>
          <h4 class="modal-title">Dialog Box</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" id="id_rab_rev" name="id_rab_rev" value="" />
          <div class="form-group">
            <label>Apakah Anda Yakin Melakukan Revisi pada RAB ini ?</label>
          </div>
          <div class="form-group">
            <label>Pesan</label>
            <textarea rows="5" type="text" class="form-control" id="pesan" name="pesan" placeholder="Pesan" style="resize:none;" required></textarea>
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
<div class="modal fade" id="pesanrevisi">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header" style="background-color:#2B91CF !important; color:white;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color:white">×</span></button>
          <h4 class="modal-title">Info</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Pesan</label>
            <textarea rows="5" type="text" class="form-control" id="vpesan" name="vpesan" placeholder="Pesan" style="resize:none;" readonly></textarea>
          </div>
        </div>
    </div>
  </div>
</div> -->
<div class="modal fade" id="delete">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo $url_rewrite;?>process/kegiatan/delete" method="POST">
        <input type="hidden" name="idrkakl" value="<?php echo $idrkakl;?>">
        <div class="modal-header" style="background-color:#2B91CF !important; color:white;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color:white">×</span></button>
          <h4 class="modal-title">Dialog Box</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" id="id_rab_del" name="id" value="" />
          <div class="form-group">
            <label>Apakah Anda Yakin Ingin Melakukan Penghapusan Data ?</label>
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
      <form action="<?php echo $url_rewrite;?>process/kegiatan/lock" method="POST">
        <div class="modal-header" style="background-color:#2B91CF !important; color:white;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color:white">×</span></button>
          <h4 class="modal-title">Dialog Box</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" id="id_rab_unlock" name="id_rab_unlock" />
          <input type="hidden" id="statuslock" name="statuslock" value="4" />
          <input type="hidden" name="idrkakl" value="<?php echo $idrkakl;?>" />
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
      <form action="<?php echo $url_rewrite;?>process/kegiatan/lock" method="POST">
        <div class="modal-header" style="background-color:#2B91CF !important; color:white;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color:white">×</span></button>
          <h4 class="modal-title">Dialog Box</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" id="id_rab_lock" name="id_rab_lock" />
          <input type="hidden" id="statuslock" name="statuslock" value="0" />
          <input type="hidden" name="idrkakl" value="<?php echo $idrkakl;?>" />
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
  $(function () {
    table = $("#table").DataTable({
      "info":false,
        "oLanguage": {
          "sInfoFiltered": ""
        },
        "processing": true,
        "serverSide": true,
        "scrollX": true,
        "ajax": {
          "url": "<?php echo $base_process;?>kegiatan/table-kegiatan",
          "type": "POST",
          "data": {'idrkakl':'<?php echo $idrkakl;?>',
                    'tahun':$('#thang').val(),
                    'direktorat':$('#kdgiat').val(),
                    'kdoutput':$('#kdoutput').val(),
                    'kdsoutput':$('#kdsoutput').val(),
                    'kdkmpnen':$('#kdkmpnen').val(),
                    'kdskmpnen':$('#kdskmpnen').val(),
                     }
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
        <?php }else{?>
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
    $(document).on("click", "#btn-lock", function (){
      var tr = $(this).closest('tr');
      tabrow = table.row(tr);
      $("#id_rab_lock").val(tabrow.data()[0]);
    });
    $(document).on("click", "#btn-unlock", function (){
      var tr = $(this).closest('tr');
      tabrow = table.row(tr);
      $("#id_rab_unlock").val(tabrow.data()[0]);
    });
    cektriwulan();
    chprog();
  });

function cektriwulan(){
  $.ajax({
    type: "post",
    url : "<?php echo $base_process;?>kegiatan/gettriwulan",
    success: function(data) {
      if (data == "null") {
        $('#tbl-tambah').hide();
      }else{
        $('#tbl-tambah').show();
      };
    }
  });
}
</script>
