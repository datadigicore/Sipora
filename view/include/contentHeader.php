<div class="headimage">
  <img src='<?php echo $base_url ?>static/img/header.png'>
</div>
<link rel="stylesheet" href="<?php echo $url_rewrite;?>static/plugins/iCheck/square/blue.css">
<body class="hold-transition skin-blue layout-top-nav">
  <div class="wrapper">
    <header class="main-header">
      <nav class="navbar navbar-static-top">
        <div class="container">
          <div class="navbar-header">
            <a href="<?php echo $url_rewrite;?>content/home" class="navbar-brand" style="color:black"><b>KEMENPORA</b></a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
              <i class="fa fa-bars"></i>
            </button>
          </div>
          <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
            <ul class="nav navbar-nav">
            <?php if ($_SESSION['level'] == 0): ?>
              <li class="active"><a href="<?php echo $url_rewrite;?>content/home">Dashboard<span class="sr-only">(current)</span></a></li>
              <li><a href="<?php echo $url_rewrite;?>content/anggaran">Anggaran</a></li>
              <li><a href="<?php echo $url_rewrite;?>content/kegiatan">Kegiatan</a></li>
              <li><a href="<?php echo $url_rewrite;?>content/laporan">Laporan</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pengaturan <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu" style="background: white;">
                  <li><a href="<?php echo $url_rewrite;?>content/pengguna">Pengguna</a></li>
                  <li class="divider"></li>
                  <li><a href="<?php echo $url_rewrite;?>content/triwulan">Triwulan</a></li>
                </ul>
              </li>
            <?php endif ?>
            <?php if ($_SESSION['level'] != 0 ): ?>
              <li class="active"><a href="<?php echo $url_rewrite;?>content/home">Dashboard<span class="sr-only">(current)</span></a></li>
              <li><a href="<?php echo $url_rewrite;?>content/kegiatan">Kegiatan</a></li>
              <li><a href="<?php echo $url_rewrite;?>content/laporan">Laporan</a></li>
            <?php endif ?>
            </ul>
          </div>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo $url_rewrite;?>static/dist/img/Kemenpora.png" class="img-circle" alt="User Image" style="width: 18px; height: 18px">
                  <span class="hidden-xs">Admin</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="user-header">
                    <img src="<?php echo $url_rewrite;?>static/dist/img/Kemenpora.png" class="img-circle" alt="User Image">
                    <p style="margin-bottom: 0">
                      <?php echo $_SESSION['username'];?><br>
                      <small>Administrator Web</small>
                    </p>
                  </li>
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?php echo $url_rewrite?>content/edit_profile" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo $url_rewrite;?>logout" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <div class="modal fade" id="editProfil">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header" style="background-color:#2B91CF !important; color:white;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" style="color:white">×</span></button>
            <h4 class="modal-title">Edit Profil</h4>
          </div>
          <div class="modal-body" style="background:white !improtant">
            <div class="form-group">
              <input type="text" class="form-control" name="name" placeholder="Nama Lengkap"  value="<?php echo $_SESSION['nama'];?>" required>
            </div>
            <div class="form-group">
              <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $_SESSION['email'];?>" required>
            </div>
            <div class="form-group">
              <div class="checkbox icheck" style="position:absolute;margin:6px;right:16px;background:white;">
                <input type="checkbox">  
              </div>
              <input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo $_SESSION['username'];?>" readonly>
            </div>
            <div class="form-group">
              <div class="checkbox icheck" style="position:absolute;margin:6px;right:16px;background:white;">
                <input type="checkbox">
              </div>
              <input type="password" class="form-control" name="password" placeholder="Password" readonly>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-flat btn-success">Simpan Perubahan</button>
          </div>
        </div>
      </div>
    </div>
    <script src="<?php echo $url_rewrite;?>static/plugins/iCheck/icheck.min.js"></script>
    <script type="text/javascript">
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%'
        });
      });
    </script>