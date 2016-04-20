<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Data RAB 
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-table"></i> <b>
        <a href="<?php echo $url_rewrite?>content/rab"> Data RAB</a> 
        > Tambah RAB 
        </b>
      </li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-9 col-xs-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title" style="margin-top:6px;">Tambah RAB</h3>
          </div>
          <form action="<?php echo $base_process;?>kegiatan/save" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="idrkakl" value="<?php echo $idrkakl;?>">
            <div class="box-body">
              <div class="form-group">
                <label>Tahun Anggaran</label>
                <select class="form-control" name="tahun" id="tahun" required>
                    <?php $rab->getYear(); ?>
                </select>
              </div>
              <input type="hidden" id="prog" name="prog" value="01" />
              <?php if ($_SESSION['direktorat'] == "") { ?>
              <div class="form-group">
                <label>Kode Kegiatan</label>
                <select class="form-control" id="direktorat" name="direktorat" onchange="chout()">
                      <?php $rab->kdkegiatan(); ?>
                </select>
              </div>
              <?php } else{ ?>
              <input type="hidden" id="direktorat" name="direktorat" value="<?php echo $_SESSION['direktorat']; ?>" />
              <?php } ?>
              <div class="form-group">
                <label>Output</label>
                <select class="form-control" id="output" name="output" onchange="chout()" required>
                  <?php $rab->getout($idrkakl);?>
                </select>
              </div>
              <div class="form-group">
                <label>Suboutput</label>
                <select class="form-control" id="soutput" name="soutput" onchange="chsout()" >
                  <?php $rab->getsout($idrkakl);?>
                </select>
              </div>
              <div class="form-group">
                <label>Komponen</label>
                <select class="form-control" id="komp" name="komp" onchange="chkomp()">
                  <?php $rab->getkomp($idrkakl);?>
                </select>
              </div>
              <div class="form-group">
                <label>Sub Komponen</label>
                <select class="form-control" id="skomp" name="skomp" onchange="chskomp()" >
                  <?php $rab->getskomp($idrkakl);?>
                </select>
              </div>
              <div class="form-group">
                <label>Uraian Acara</label>
                <textarea rows="5" type="text" class="form-control" id="uraian" name="uraian" placeholder="Uraian Acara" style="resize:none;" required></textarea>
              </div>
              <div class="form-group">
                <label>Tanggal Awal</label>
                <input class="form-control tanggal" onchange="cektanggal()" type="text" id="tanggal" name="tanggal" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" required />
              </div>
              <div class="form-group">
                <label>Tanggal Akhir</label>
                <input class="form-control tanggal" onchange="cektanggal()" type="text" id="tanggal_akhir" name="tanggal_akhir" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" required />
              </div>
              <div class="form-group">
                <label>Tempat Kegiatan</label>
                <input type="text" class="form-control" id="tempat" name="tempat" placeholder="Tempat Kegiatan" required />
              </div>
              <div class="form-group">
                <label>Kota</label>
                <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Kota" required />
              </div>
              <div class="form-group">
                <label>Volume Kegiatan</label>
                <input type="text" style="width:30%" class="form-control nomor" id="volume" name="volume" placeholder="Volume" required />
                <input type="text" style="width:20%" class="form-control" id="satuan" name="satuan" placeholder="Satuan" required />
              </div>
              <div class="form-group">
                <label>Realisasi</label>
                <input type="text" class="form-control uang" id="realisasi" name="realisasi" placeholder="Realisasi" required />
              </div>
              
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-flat btn-success">Save</button>
            </div>
          </form>
         </div>        
      </div>
    </div>
  </section>
</div>

<script>
$(function() {

  $("#tanggal").datepicker({
      autoclose: true,
      monthNames: [ "Januari", "Pebruari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember" ],
      changeMonth: true,
      dateFormat: 'dd/mm/yy',
      onClose: function(selectedDate) {
        $("#tanggal_akhir").datepicker("option", "minDate", selectedDate);
      }
  });

  $("#tanggal_akhir").datepicker({ 
      autoclose: true,
      monthNames: [ "Januari", "Pebruari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember" ],
      changeMonth: true,
      changeYear: true,
      dateFormat: 'dd/mm/yy'
  });
  $("#tanggal_akhir").datepicker({ 
      changeMonth: true,
      changeYear: true,
      dateFormat: 'dd/mm/yy'
  });
  // chprog();
  $('.tanggal').mask('00/00/0000');
    $('.uang').mask('000.000.000.000.000.000.000', {reverse: true});
    $('.nomor').mask('0000');
});

function cektanggal(){
  var tanggal = $('#tanggal').val();
  var tanggal_akhir = $('#tanggal_akhir').val();
  var pecah_awal = tanggal.split("/"); 
  var pecah_akhir = tanggal_akhir.split("/"); 
  var parsed_awal = new Date(pecah_awal[2],pecah_awal[1],pecah_awal[0]); 
  var parsed_akhir = new Date(pecah_akhir[2],pecah_akhir[1],pecah_akhir[0]); 
  if (parsed_akhir < parsed_awal) {
    $('#tanggal_akhir').val('');
    alert("Tanggal Akhir Kurang Dari Tanggal Awal");
  };
}

  </script>