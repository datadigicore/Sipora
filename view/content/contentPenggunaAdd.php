<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Data Pengguna
      <small>Management Control</small>
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-group"></i> Data Pengguna</li>
      <li><i class="fa fa-user"></i> Tambah Pengguna</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-9 col-xs-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title" style="margin-top:6px;">Tambah Pengguna</h3>
          </div>
          <form method="POST" action="<?php echo $base_process;?>user/add">
            <div class="box-body">
              <?php include "view/include/contentAlert.php" ?>
              <div class="form-group">
                <input type="text" class="form-control" name="name" placeholder="Nama Lengkap" required>
              </div>
              <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email" required>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="Username" required>
              </div>
              <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
              </div>
              <div class="form-group">
                <select class="form-control" name="level" required>
                  <option value="" disabled selected>-- Pilih Kewenangan --</option>
                  <option value="2">Bendahara Pengeluaran Pembantu</option>
                  <option value="3">Operator Bendahara Pengeluaran Pembantu</option>
                </select>
              </div>
              <div class="form-group">
                <select id="direktorat" class="form-control select2" name="direktorat" required style="width:100%">
                  <option value="" disabled selected>-- Pilih Direktorat --</option>
                  <?php $pengguna->kdkegiatan(); ?>
                </select>
              </div>
              <div class="form-group">
                <select class="form-control" name="status" required>
                  <option value="" disabled>-- Pilih Status Akun --</option>
                  <option value="1" selected>Aktif</option>
                  <option value="0">Tidak Aktif</option>
                </select>
              </div>
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-success pull-right">Submit</button>
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