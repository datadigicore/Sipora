<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Data Pengguna
      <small>Management Control</small>
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-user"></i> Tambah Pengguna</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title" style="margin-top:6px;">Tambah Pengguna</h3>
          </div>
          <form method="POST" action="<?php echo $base_process;?>pengguna/add">
            <div class="row">
              <div class="col-md-6 col-md-offset-3">
                <div class="box-body form-horizontal">
                  <?php include "view/include/contentAlert.php" ?>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Nama</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="name" placeholder="Nama Lengkap" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" name="email" placeholder="Email" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">username</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="username" placeholder="Username" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">  
                      <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Kewenangan</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="level" required>
                        <option value="" disabled selected>-- Pilih Kewenangan --</option>
                        <option value="2">Bendahara Pengeluaran Pembantu</option>
                        <option value="3">Operator Bendahara Pengeluaran Pembantu</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Direktorat</label>
                    <div class="col-sm-10">
                      <select id="direktorat" class="form-control select2" name="direktorat" required style="width:100%">
                        <option value="" disabled selected>-- Pilih Direktorat --</option>
                        <?php $pengguna->kdkegiatan(); ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-10">  
                      <select class="form-control" name="status" required>
                        <option value="" disabled>-- Pilih Status Akun --</option>
                        <option value="1" selected>Aktif</option>
                        <option value="0">Tidak Aktif</option>
                      </select>
                    </div>  
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="box-footer">
                  <div class="col-md-9">
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
  $("#direktorat").select2();
});
</script>