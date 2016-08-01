<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Publikasi Berita
      <small>Management Control</small>
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-user"></i> Tambah Berita</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title" style="margin-top:6px;">Tambah Berita</h3>
          </div>
          <form method="POST" action="<?php echo $base_process;?>berita/add">
            <div class="row">
              <div class="col-md-8 col-md-offset-2">
                <div class="box-body well form-horizontal">
                  <?php include "view/include/contentAlert.php" ?>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Tanggal</label>
                    <div class="col-sm-10">
                      <input class="form-control tanggal" type="text" id="tanggal" name="tanggal" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" required />
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Judul</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="judul" placeholder="Judul Berita" required>
                    </div>
                  </div>
                  <textarea id="summernote" name="isi"></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">

                <div class="box-footer">
                  <div class="col-md-10" id="button">
                  <button type="submit" class="btn btn-success pull-right col-md-2">Submit</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title" style="margin-top:6px;">List Berita</h3>
          </div>
          <div class="box-body">
            <?php include "view/include/contentAlert.php" ?>
            <table id="table" class="display nowrap table table-bordered table-striped" cellspacing="0" width="100%">
              <thead style="background-color:#2B91CF;color:white;">
                <tr>
                  <th>Id</th>
                  <th>No</th>
                  <th>Tanggal Berita</th>
                  <th>Judul Berita</th>
                  <th>Isi Berita</th>
                  <th>Status Berita</th>
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
<div class="modal fade" id="hapusModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="<?php echo $base_process;?>berita/delete">
        <div class="modal-header" style="background-color:#d33724 !important; color:white;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color:white">×</span></button>
          <h4 class="modal-title">Hapus Berita</h4>
        </div>
        <div class="modal-body">
          <p>Anda yakin ingin menghapus berita ini?</p>
          <input type="hidden" name="id" id="modid"></input>
          <table>
            <tr>
              <td>Tanggal Berita</td>
              <td>&nbsp;:&nbsp;</td>
              <td id="modtanggal"></td>
            </tr>
            <tr>
              <td>Judul Berita</td>
              <td>&nbsp;:&nbsp;</td>
              <td id="modjudul"></td>
            </tr>
          </table>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-flat btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="editModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="<?php echo $base_process;?>berita/edit">
        <div class="modal-header" style="background-color:#00a65a !important; color:white;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color:white">×</span></button>
          <h4 class="modal-title">Edit Berita</h4>
        </div>
        <div class="col-md-12">
          <div class="box-body well form-horizontal">
            <input type="hidden" name="id" id="edtid"></input>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Tanggal</label>
              <div class="col-sm-10">
                <input class="form-control tanggal" type="text" id="edttanggal" name="tanggal" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" required />
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Judul</label>
              <div class="col-sm-10">
                <input type="text" id="edtjudul" class="form-control" name="judul" placeholder="Judul Berita" required>
              </div>
            </div>
            <textarea id="edtsummernote" name="isi"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-flat btn-success">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $("#tanggal").datepicker({
      autoclose: true,
      monthNames: [ "Januari", "Pebruari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember" ],
      maxDate: 0,
      changeMonth: true,
      dateFormat: 'dd/mm/yy',
  });
    $("#edttanggal").datepicker({
      autoclose: true,
      monthNames: [ "Januari", "Pebruari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember" ],
      maxDate: 0,
      changeMonth: true,
      dateFormat: 'dd/mm/yy',
  });
    var table = $("#table").DataTable({
    "info":true,
    "oLanguage": {
      "sInfoFiltered": ""
    },
    "processing": true,
    "serverSide": true,
    "scrollX": true,
    "ajax": {
      "url": "<?php echo $url_rewrite;?>process/berita/table",
      "type": "POST",
      "data": { }
    },
    "columnDefs" : [
      {"targets": 0,
       "visible": false},
      {"targets": 1,
       "data"   : null,
       "searchable": false,
       "orderable": false},
      {"orderable": false,
       "data": null,
       "defaultContent":  '<div class="text-center">'+
                            '<a style="margin:0 2px;" id="btn-edt" href="#editModal" class="btn btn-flat btn-success btn-sm" data-toggle="modal"><i class="fa fa-edit"></i> Edit</a>'+
                            '<a style="margin:0 2px;" id="btn-del" href="#hapusModal" class="open-deleteProject btn btn-flat btn-danger btn-sm" data-toggle="modal"><i class="fa fa-trash-o"></i> Hapus</a>'+
                          '</div>',
       "targets": 6 },
    ],
    "order": [ 2, "asc" ]
  });
  table.on( 'order.dt search.dt draw.dt', function () {
    table.column(1, {search:'applied', order:'applied', draw:'applied'}).nodes().each( function (cell, i) {
      cell.innerHTML = i+1;
    });
  }).draw();
  $(document).on("click", "#btn-del", function (){
      var tr = $(this).closest('tr');
      tabrow = table.row( tr );
      $("#modid").val(tabrow.data()[0]);
      $("#modtanggal").text(tabrow.data()[2]);
      $("#modjudul").text(tabrow.data()[3]);
    });
  $(document).on("click", "#btn-edt", function (){
      var tr = $(this).closest('tr');
      tabrow = table.row( tr );
      $("#edtid").val(tabrow.data()[0]);
      $("#edttanggal").text(tabrow.data()[2]);
      $("#edtjudul").text(tabrow.data()[3]);
      $("#edtsummernote").text(tabrow.data()[4]);
    });
    $('#summernote').summernote({
          height: 300,
          callbacks: {
            // onImageUpload: function(files, editor, welEditable) {
            //   alert
            //   sendFile(files[0], editor, welEditable);
            // },
            onImageUpload: function(files) {

              
              data = new FormData();
              data.append("file", files[0]);//You can append as many data as you want. Check mozilla docs for this
              $.ajax({
                  data: data,
                  type: "POST",
                  url: '<?php echo $base_process;?>berita/uploadImg',
                  cache: false,
                  contentType: false,
                  processData: false,
                  success: function(node) {
                      // editor.summernote('insertImage', url, welEditable);
                      // var node = document.createElement('div');
                      $('#summernote').summernote('insertImage', node);
                  }
              });
              // upload image to server and create imgNode...
              // sendFile(files[0], editor, welEditable);
              // $summernote.summernote('insertNode', imgNode);
            }
          }
         });
    $('#edtsummernote').summernote({
          height: 200,
          callbacks: {
            // onImageUpload: function(files, editor, welEditable) {
            //   alert
            //   sendFile(files[0], editor, welEditable);
            // },
            onImageUpload: function(files) {

              
              data = new FormData();
              data.append("file", files[0]);//You can append as many data as you want. Check mozilla docs for this
              $.ajax({
                  data: data,
                  type: "POST",
                  url: '<?php echo $base_process;?>berita/uploadImg',
                  cache: false,
                  contentType: false,
                  processData: false,
                  success: function(node) {
                      // editor.summernote('insertImage', url, welEditable);
                      // var node = document.createElement('div');
                      $('#edtsummernote').summernote('insertImage', node);
                  }
              });
              // upload image to server and create imgNode...
              // sendFile(files[0], editor, welEditable);
              // $summernote.summernote('insertNode', imgNode);
            }
          }
         });
  });
</script>