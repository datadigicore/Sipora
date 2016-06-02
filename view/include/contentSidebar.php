<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo $url_rewrite;?>static/dist/img/Kemenpora.png" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $_SESSION['username'];?></p>
        <small>Administrator Web</small>
      </div>
    </div>
    <ul class="sidebar-menu">
      <li class="header">MENU NAVIGATION</li>
      <?php if ($_SESSION['level'] == 0): ?>
        <li class="active"><a href="<?php echo $url_rewrite;?>content/home"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li><a href="<?php echo $url_rewrite;?>content/anggaran"><i class="fa fa-table"></i> <span>Data Anggaran</span></a></li>
        <li><a href="<?php echo $url_rewrite;?>content/kegiatan"><i class="fa fa-table"></i> <span>Data Kegiatan</span></a></li>           
        <li><a href="<?php echo $url_rewrite;?>content/laporan"><i class="fa fa-file-text"></i> <span>Cetak Laporan</span></a></li>
        <li><a href="<?php echo $url_rewrite;?>content/pengguna"><i class="fa fa-group"></i> <span>Data Pengguna</span></a></li>
      <?php endif ?>
      <?php if ($_SESSION['level'] != 0 ): ?>
        <li class="active"><a href="<?php echo $url_rewrite;?>content/home"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li><a href="<?php echo $url_rewrite;?>content/kegiatan"><i class="fa fa-table"></i> <span>Data Kegiatan</span></a></li>
        <li><a href="<?php echo $url_rewrite;?>content/laporan"><i class="fa fa-file-text"></i> <span>Cetak Laporan</span></a></li>
      <?php endif ?>
    </ul>
  </section>
</aside>
