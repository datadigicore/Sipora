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
                    <label for="inputPassword3" class="col-sm-2 control-label">Content</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="jenis" required>
                        <option value="" disabled selected>-- Pilih Konten Berita --</option>
                        <option value="1">Berita Utama</option>
                        <option value="2">Berita Terkait</option>
                        <option value="3">Berita Kementerian</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Judul</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="judul" placeholder="Judul Berita" required>
                    </div>
                  </div>
                  <textarea class="input-block-level" id="summernote" name="isi" ></textarea>
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
      </div>
    </div>
  </section>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    // $('.summernote').summernote();
    // $('.summernote').on('insertImage', function(we, files) {
    //   // upload image to server and create imgNode...
    //   alert("tes");
    //   $summernote.summernote('insertNode', imgNode);
    // });
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


  });

  // function getContent(value) {
  //   $.ajax({
  //      type: 'post',
  //      url: '<?php echo $base_process;?>berita/getContent',
  //      data: {option:value},
  //      success: function (response) {
  //        $("#content").html(response);
  //        $("#button").html('<button type="submit" class="btn btn-success pull-right col-md-2">Submit</button>');
         
  //      }
  //   });
  // }
</script>