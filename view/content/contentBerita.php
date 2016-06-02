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
          <form method="POST" action="<?php echo $base_process;?>pengguna/add">
            <div class="row">
              <div class="col-md-8 col-md-offset-2">
                <div class="box-body well form-horizontal">
                  <?php include "view/include/contentAlert.php" ?>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Content</label>
                    <div class="col-sm-10">
                      <select onchange="getContent(this.value);" class="form-control" required>
                        <option value="" disabled selected>-- Pilih Konten Berita --</option>
                        <option value="utama">Berita Utama</option>
                        <option value="terkait">Berita Terkait</option>
                        <option value="menteri">Berita Kementerian</option>
                      </select>
                    </div>
                  </div>
                  <div id="content"></div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="box-footer">
                  <div class="col-md-10" id="button">
                  <!-- <button type="submit" class="btn btn-success pull-right col-md-2">Submit</button> -->
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
  function getContent(value) {
    $.ajax({
       type: 'post',
       url: '<?php echo $base_process;?>berita/getContent',
       data: {option:value},
       success: function (response) {
         $("#content").html(response);
         $("#button").html('<button type="submit" class="btn btn-success pull-right col-md-2">Submit</button>');
       }
    });
  }
</script>
<script>
var editor = new wysihtml5.Editor("wysihtml5-textarea", { // id of textarea element
  toolbar:      "wysihtml5-toolbar", // id of toolbar element
  parserRules:  wysihtml5ParserRules // defined in parser rules set 
});
</script>