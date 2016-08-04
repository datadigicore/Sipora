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
      <div class="col-md-10 col-md-offset-1">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title" style="margin-top:6px;">Tambah RAB</h3>
          </div>
          <form action="<?php echo $base_process;?>kegiatan/edit/<?php echo $idview;?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $idview;?>">
            <input type="hidden" id="idrkakl" name="idrkakl" value="<?php echo $idrkakl;?>">
            <div class="row">
              <div class="col-md-10 col-md-offset-1">    
                <div class="box-body well">
                  <div class="form-group">
                    <label>Tahun Anggaran</label>
                    <select class="form-control" name="thang" id="tahun" required>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Status Triwulan</label>
                    <select class="form-control" name="idtriwulan" id="idtriwulan" required>
                      <option value="<?php echo $getview['idtriwulan'];?>">Triwulan <?php echo $getview['idtriwulan'];?></option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Program</label>
                    <select class="form-control" id="program" name="kdprogram" required>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Kegiatan</label>
                    <select class="form-control" id="giat" name="kdgiat" required>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Output</label>
                    <select class="form-control" id="output" name="kdoutput" required>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Suboutput</label>
                    <select class="form-control" id="soutput" name="kdsoutput"  >
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Komponen</label>
                    <select class="form-control" id="kmpnen" name="kdkmpnen" >
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Sub Komponen</label>
                    <select class="form-control" id="skmpnen" name="kdskmpnen" >
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Uraian Acara</label>
                    <textarea rows="5" type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Uraian Acara" style="resize:none;" required><?php echo $getview['deskripsi'];?></textarea>
                  </div>
                  <div class="form-group">
                    <label>Tanggal Awal</label>
                    <input class="form-control tanggal" onchange="cektanggal()" type="text" id="tanggal" name="tanggal" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" required value="<?php echo date("d/m/Y", strtotime($getview['tanggal']))?>"/>
                  </div>
                  <div class="form-group">
                    <label>Tanggal Akhir</label>
                    <input class="form-control tanggal" onchange="cektanggal()" type="text" id="tanggal_akhir" name="tanggal_akhir" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" required value="<?php echo date("d/m/Y", strtotime($getview['tanggal_akhir']));?>"/>
                  </div>
                  <div class="form-group">
                    <label>Tempat Kegiatan</label>
                    <input type="text" class="form-control" id="tempat" name="tempat" placeholder="Tempat Kegiatan" required value="<?php echo $getview['tempat'];?>" />
                  </div>
                  <div class="form-group">
                    <label>Kota</label>
                    <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Kota" required value="<?php echo $getview['lokasi'];?>"/>
                  </div>
                  <div class="form-group">
                    <label>Realisasi</label>
                    <input type="text" class="form-control uang" id="jumlah" name="jumlah" placeholder="Jumlah" required value="<?php echo number_format($getview['jumlah']);?>"/>
                  </div> 
                  <div class="form-group">
                    <label>Dokumen Pendukung</label>
                  </div>
                  <div class="form-group">
                      <input type="file" id="fileimport" name="fileimport" style="display:none;">
                      <a id="selectbtn" class="btn btn-flat btn-primary" style="position:absolute;right:16px;">Select File</a>
                      <input type="text" id="filename" class="form-control" placeholder="<?php echo $getview['dokumen'];?>" readonly>
                  </div> 
                  <input type="hidden" name="filelama" value="<?php echo $getview['dokumen'];?>"/>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
              <div class="box-footer">
                <div class="col-md-11">
                <button type="submit" class="btn btn-flat btn-success pull-right col-md-2">Simpan</button>
                </div>
              </div>
              </div>
            </div>
          </form>
         </div>        
      </div>
    </div>
  </section>
</div>

<script>
$( document ).ready(function() {
    getyear();
});
$(function() {
  $('.readonly').bind('paste', function (e) {
      e.preventDefault();
  });
  $(".readonly").keydown(function(e){
      e.preventDefault();
  });
  $("#tanggal").datepicker({
      autoclose: true,
      monthNames: [ "Januari", "Pebruari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember" ],
      maxDate: 0,
      changeMonth: true,
      dateFormat: 'dd/mm/yy',
      onClose: function(selectedDate) {
        $("#tanggal_akhir").datepicker("option", "minDate", selectedDate);
      }
  });

  $("#tanggal_akhir").datepicker({ 
      autoclose: true,
      monthNames: [ "Januari", "Pebruari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember" ],
      maxDate: 0,
      changeMonth: true,
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

  $('#selectbtn').click(function () {
    $("#fileimport").trigger('click');
  });
  $("#fileimport").change(function(){
    $("#filename").attr('value', $(this).val().replace(/C:\\fakepath\\/i, ''));
  });
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

function getkode(){
    $("#output option").remove();   
    $("#soutput option").remove();   
    $("#kmpnen option").remove();   
    $("#skmpnen option").remove();   
    var idrkakl = $('#idrkakl').val();
    var tahun = $('#tahun').val();
    var kdgiat = $('#kdgiat').val();
    $.ajax({
      type: "POST",
      url: "<?php echo $url_rewrite;?>process/kegiatan/getkode",
      data: { 'idrkakl' : idrkakl,
              'tahun' : tahun,
              'kdgiat' : kdgiat
            },
      success: function(data){
        var obj = jQuery.parseJSON(data);
        $('#program').append('<option value="'+obj[0].KDPROGRAM+'" selected>'+obj[0].KDPROGRAM+'</option>');
        $('#giat').append('<option value="'+obj[0].KDGIAT+'" selected>'+obj[0].KDGIAT+' - '+obj[0].NMGIAT+'</option>');
        $('#output').append('<option value="'+obj[0].KDOUTPUT+'" selected>'+obj[0].KDOUTPUT+' - '+obj[0].NMOUTPUT+'</option>');
        $('#soutput').append('<option value="'+obj[0].KDSOUTPUT+'" selected>'+obj[0].KDSOUTPUT+' - '+obj[0].NMSOUTPUT+'</option>');
        $('#kmpnen').append('<option value="'+obj[0].KDKMPNEN+'" selected>'+obj[0].KDKMPNEN+' - '+obj[0].NMKMPNEN+'</option>');
        $('#skmpnen').append('<option value="'+obj[0].KDSKMPNEN+'" selected>'+obj[0].KDSKMPNEN+' - '+obj[0].NMSKMPNEN+'</option>');
      },
    });
  }

function getyear(){   
  var idrkakl = $('#idrkakl').val();
  $.ajax({
    type: "POST",
    url: "<?php echo $url_rewrite;?>process/kegiatan/getyear",
    data: { 'idrkakl' : idrkakl },
    success: function(data){
      var obj = jQuery.parseJSON(data);
      $('#tahun').append('<option value="'+obj[0].THANG+'" selected>'+obj[0].THANG+'</option>');
      getkode();
    },
  });
}


  </script>