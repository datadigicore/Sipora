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
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title" style="margin-top:6px;">Tabel Rencana Kegiatan</h3>
            <?php 
            if ($_SESSION['level'] != '0') {
              echo '<a href="'.$base_content.'rab/tambah" class="btn btn-flat btn-success btn-md pull-right"><i class="fa fa-plus"></i>&nbsp;Tambah RAB</a>';
            }
            ?>
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
                  <label><?php echo $direk[$_SESSION['direktorat']];?></label>
                  <input type="hidden" id="direktorat2" name="direktorat2" value="<?php echo $_SESSION['direktorat']; ?>" />
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
          "url": "<?php echo $base_process;?>rab/table-rkakl",
          "type": "POST",
          "data": {'tahun':tahun,
                    'direktorat':direktorat }
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
            {"targets" : 1,
              "visible" : false},
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
    chprog();
  });

  function search(){
    var tahun = $('#tahun2').val();
    var direktorat = $('#direktorat2').val();
    table.destroy();
    table = $("#table").DataTable({
        "info":false,
        "oLanguage": {
          "sInfoFiltered": ""
        },
        "processing": true,
        "serverSide": true,
        "scrollX": true,
        "ajax": {
          "url": "<?php echo $base_process;?>rab/table-rkakl",
          "type": "POST",
          "data": {'tahun':tahun,
                    'direktorat':direktorat }
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
            {"targets" : 1,
              "visible" : false},
            {"targets" : 2},
            {"targets" : 3},
            {"targets" : 4},
            {"targets" : 5},
            {"targets" : 6},
          ],
        <?php } ?>
        "order": [[ 0, "desc" ]]
    });
  }

  function chprog(){
    $("#output option").remove();   
    $("#soutput option").remove();   
    $("#komp option").remove();   
    $("#skomp option").remove();   
    $('#output').append('<option>-- Pilih Output --</option>');
    $('#soutput').append('<option>-- Pilih Sub Output --</option>');
    $('#komp').append('<option>-- Pilih Komponen --</option>');
    $('#skomp').append('<option>-- Pilih Sub Komponen --</option>');
    var tahun = $('#tahun').val();
    var direktorat = $('#direktorat').val();
    var prog = $('#prog').val();
    $.ajax({
      type: "POST",
      url: "<?php echo $base_process;?>rab/getout",
      data: { 'prog' : prog,
              'tahun' : tahun,
              'direktorat' : direktorat
            },
      success: function(data){
        var obj = jQuery.parseJSON(data);
        for (var i = 0; i < obj.KDOUTPUT.length; i++) {
          $('#output').append('<option value="'+obj.KDOUTPUT[i]+'">'+obj.KDOUTPUT[i]+' - '+obj.NMOUTPUT[i]+'</option>')
        };
      },
    });
  }
  function chout(){
    var prog = $('#prog').val();
    var output = $('#output').val();
    var tahun = $('#tahun').val();
    var direktorat = $('#direktorat').val();
    $.ajax({
      type: "POST",
      url: "<?php echo $base_process;?>rab/getsout",
      data: { 'prog' : prog,
              'output' : output,
              'tahun' : tahun,
              'direktorat' : direktorat
            },
      success: function(data){
        var obj = jQuery.parseJSON(data);
        for (var i = 0; i < obj.KDSOUTPUT.length; i++) {
          $('#soutput').append('<option value="'+obj.KDSOUTPUT[i]+'">'+obj.KDSOUTPUT[i]+' - '+obj.NMSOUTPUT[i]+'</option>')
        };
      },
    });
  }
  function chsout(){
    $("#komp option").remove();   
    $("#skomp option").remove();   
    $('#komp').append('<option>-- Pilih Komponen --</option>');
    $('#skomp').append('<option>-- Pilih Sub Komponen --</option>');
    var tahun = $('#tahun').val();
    var direktorat = $('#direktorat').val();
    var prog = $('#prog').val();
    var output = $('#output').val();
    var soutput = $('#soutput').val();
    $.ajax({
      type: "POST",
      url: "<?php echo $base_process;?>rab/getkomp",
      data: { 'prog' : prog,
              'output' : output,
              'soutput' : soutput,
              'tahun' : tahun,
              'direktorat' : direktorat
            },
      success: function(data){
        var obj = jQuery.parseJSON(data);
        for (var i = 0; i < obj.KDKMPNEN.length; i++) {
          $('#komp').append('<option value="'+obj.KDKMPNEN[i]+'">'+obj.KDKMPNEN[i]+' - '+obj.NMKMPNEN[i]+'</option>')
        };
      },
    });
  }
  function chkomp(){
    $("#skomp option").remove();   
    $('#skomp').append('<option>-- Pilih Sub Komponen --</option>');
    var tahun = $('#tahun').val();
    var direktorat = $('#direktorat').val();
    var prog = $('#prog').val();
    var output = $('#output').val();
    var soutput = $('#soutput').val();
    var komp = $('#komp').val();
    $.ajax({
      type: "POST",
      url: "<?php echo $base_process;?>rab/getskomp",
      data: { 'prog' : prog,
              'output' : output,
              'soutput' : soutput,
              'komp' : komp,
              'tahun' : tahun,
              'direktorat' : direktorat
            },
      success: function(data){
        var obj = jQuery.parseJSON(data);
        for (var i = 0; i < obj.KDSKMPNEN.length; i++) {
          $('#skomp').append('<option value="'+obj.KDSKMPNEN[i]+'">'+obj.KDSKMPNEN[i]+' - '+obj.NMSKMPNEN[i]+'</option>')
        };
      },
    });
  }
</script>
