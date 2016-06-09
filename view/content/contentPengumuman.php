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
          <form method="POST" action="<?php echo $base_process;?>berita/addpengumuman">
            <div class="row">
              <div class="col-md-8 col-md-offset-2">
                <div class="box-body well form-horizontal">
                  <?php include "view/include/contentAlert.php" ?>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Pengumuman</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" name="isi" placeholder="Pengumuman"><?php echo $pengumuman;?></textarea>
                    </div>
                  </div>
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