<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Data Anggaran
      <small>Menu</small>
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-table"></i> Data Anggaran</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-10 col-xs-offset-1">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title" style="margin-top:6px;">Tabel Rencana Kerja dan Anggaran Kementerian/Lembaga</h3>
            <a href="#importModal" data-toggle="modal" class="btn btn-flat btn-success btn-sm pull-right">Import Anggaran</a>
          </div>
          <div class="box-body">
            <?php include "view/include/contentAlert.php" ?>
            <table id="table" class="display nowrap table table-bordered table-striped" cellspacing="0" width="100%">
              <thead style="background-color:#2B91CF;color:white;">
                <tr>
                  <th>Id</th>
                  <th>Tahun Anggaran</th>
                  <th>Tanggal DIPA</th>
                  <th>Nomor DIPA</th>
                  <th>Status</th>
                  <th>Aksi</th>
                  <th>File</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>        
      </div>
    </div>
  </section>
</div>
<div class="modal fade" id="importModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo $base_process;?>anggaran/import" method="POST" enctype="multipart/form-data">
        <div class="modal-header" style="background-color:#2B91CF !important; color:white;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color:white">×</span></button>
          <h4 class="modal-title">Import Data Anggaran</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <select class="form-control" name="thang" required>
            <?php
              echo '<option  value="" disabled selected>-- Pilih Tahun Anggaran --</option>';
              echo '<option value="'.date('Y').'">'.date('Y').'</option>';
            ?>
            </select>
          </div>
          <div class="form-group">
            <label>Tanggal DIPA</label>
            <input type="text" class="form-control tanggal" id="tanggal" name="tanggal" placeholder="dd/mm/yyyy">
          </div>
          <div class="form-group">
            <label>Nomor DIPA</label>
            <input type="text" class="form-control" id="no_dipa" name="no_dipa" placeholder="Nomor DIPA">
          </div>
          <div class="form-group">
            <input type="file" id="fileimport" name="fileimport" style="display:none;">
            <a id="selectbtn" class="btn btn-flat btn-primary" style="position:absolute;right:16px;">Select File</a>
            <input type="text" id="filename" class="form-control" placeholder="Pilih File .xls / .xlsx" readonly>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-flat btn-success">Import Data</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="editModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo $base_process;?>anggaran/import" method="POST" enctype="multipart/form-data">
        <div class="modal-header" style="background-color:#2B91CF !important; color:white;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color:white">×</span></button>
          <h4 class="modal-title">Revisi Data RKAKL</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" name="revisi" value="true">
            <input type="hidden" id="thnanggaran" name="thang">
            <input type="text" class="form-control" id="tglimport" name="tglimport" placeholder="Tanggal Import" readonly>
          </div>
          <div class="form-group">
            <label>Tanggal DIPA</label>
            <input type="text" class="form-control tanggal" id="tanggald" name="tanggal" placeholder="dd/mm/yyyy">
          </div>
          <div class="form-group">
            <label>Nomor DIPA</label>
            <input type="text" class="form-control" id="no_dipa" name="no_dipa" placeholder="Nomor DIPA">
          </div>
          <div class="form-group">
            <label>Pesan Revisi</label>
            <textarea rows="5" type="text" class="form-control" id="pesan" name="pesan" placeholder="Pesan Revisi" style="resize:none;" required></textarea>
          </div>
          <div class="form-group">
            <input type="file" id="fileimport-revisi" name="fileimport" style="display:none;">
            <a id="selectbtn-revisi" class="btn btn-flat btn-primary" style="position:absolute;right:16px;">Select File</a>
            <input type="text" id="filename-revisi" class="form-control" placeholder="Pilih File .xls / .xlsx" readonly>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-flat btn-success">Revisi Data</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="lihatpesan">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header" style="background-color:#2B91CF !important; color:white;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color:white">×</span></button>
          <h4 class="modal-title">Revisi Data RKAKL</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="vtglimport" name="vtglimport" placeholder="Tanggal Import" readonly>
          </div>
          <div class="form-group">
            <label>Tanggal DIPA</label>
            <input type="text" class="form-control tanggal" id="vtanggal" name="vtanggal" placeholder="dd/mm/yyyy" readonly>
          </div>
          <div class="form-group">
            <label>Nomor DIPA</label>
            <input type="text" class="form-control" id="vno_dipa" name="vno_dipa" placeholder="Nomor DIPA" readonly>
          </div>
          <div class="form-group">
            <label>Pesan Revisi</label>
            <textarea rows="5" type="text" class="form-control" id="vpesan" name="vpesan" placeholder="Pesan Revisi" style="resize:none;" readonly></textarea>
          </div>
        </div>
    </div>
  </div>
</div>
<script>
  $(function () {
    $('#selectbtn').click(function () {
      $("#fileimport").trigger('click');
    });
    $("#fileimport").change(function(){
      $("#filename").attr('value', $(this).val().replace(/C:\\fakepath\\/i, ''));
    });
    $('#selectbtn-revisi').click(function () {
      $("#fileimport-revisi").trigger('click');
    });
    $("#fileimport-revisi").change(function(){
      $("#filename-revisi").attr('value', $(this).val().replace(/C:\\fakepath\\/i, ''));
    });
    var table = $(".table").DataTable({
      "oLanguage": {
        "sInfoFiltered": ""
      },
      "processing": true,
      "serverSide": true,
      "scrollX"   : true,
      "ajax"      : {
        "url" : "<?php echo $base_process;?>anggaran/table",
        "type": "POST"
      },
      "columnDefs" : [
        {"targets" : 0,
         "visible" : false},
        {"targets" : 6,
         "visible" : false},
      ],
      "order" : [[0, "desc"]]
    });
    $('#tanggal, #tanggald').mask('00/00/0000');
    $("#tanggal, #tanggald").datepicker({ 
      changeMonth: true,
      changeYear : true,
      dateFormat : 'dd/mm/yy' 
    });
    $(document).on("click", "#btn-edt", function (){
      var tr = $(this).closest('tr');
      tabrow = table.row(tr);
      $("#tglimport").val('Tahun Anggaran : '+tabrow.data()[1]);
      $("#thnanggaran").val(tabrow.data()[1]);
    });
    $(document).on("click", "#btn-pesan", function (){
      var tr = $(this).closest('tr');
      tabrow = table.row(tr);
      $("#vtglimport").val('Tahun Anggaran : '+tabrow.data()[1]);
      $("#vtanggal").val(tabrow.data()[2]);
      $("#vno_dipa").val(tabrow.data()[3]);
      $("#vpesan").val(tabrow.data()[8]);
    });
    $(document).on("click", "#btn-viw", function (){
      var tr = $(this).closest('tr');
      tabrow = table.row(tr);
      var f  = document.createElement('form');
      f.setAttribute('method','post');
      f.setAttribute('target','_blank');
      f.setAttribute('action','<?php echo $url_rewrite;?>process/anggaran/view');
      var i  = document.createElement('input');
      i.setAttribute('type','hidden');
      i.setAttribute('name','filename');
      i.setAttribute('value', tabrow.data()[6]);
      f.appendChild(i);
      document.body.appendChild(f);
      f.submit();
    });
  });
</script>