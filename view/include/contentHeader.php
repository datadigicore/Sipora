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
              <li <?php if ($link[1] == 'home'){ echo "class='active'";}?>><a href="<?php echo $url_rewrite;?>content/home">Dashboard<span class="sr-only">(current)</span></a></li>
              <li <?php if ($link[1] == 'anggaran'){ echo "class='active'";}?>><a href="<?php echo $url_rewrite;?>content/anggaran">Anggaran</a></li>
              <li <?php if ($link[1] == 'kegiatan'){ echo "class='active'";}?>><a href="<?php echo $url_rewrite;?>content/kegiatan">Kegiatan</a></li>
              <li <?php if ($link[1] == 'laporan'){ echo "class='active'";}?>><a href="<?php echo $url_rewrite;?>content/laporan">Laporan</a></li>
              <li <?php if ($link[1] == 'pengguna' OR $link[1] == 'triwulan' OR $link[1] == 'prosentase'){ echo "class='dropdown active'";} else{ echo "class='dropdown'";}?>>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pengaturan <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu" style="background: white;">
                  <li><a href="<?php echo $url_rewrite;?>content/triwulan">Triwulan</a></li>
                  <li><a href="<?php echo $url_rewrite;?>content/prosentase">Prosentase</a></li>
                  <li class="divider"></li>
                  <li><a href="<?php echo $url_rewrite;?>content/pengguna">Pengguna</a></li>
                </ul>
              </li>
            <?php endif ?>
            <?php if ($_SESSION['level'] != 0 ): ?>
              <li <?php if ($link[1] == 'home'){ echo "class='active'";}?>><a href="<?php echo $url_rewrite;?>content/home">Dashboard<span class="sr-only">(current)</span></a></li>
              <li <?php if ($link[1] == 'kegiatan'){ echo "class='active'";}?>><a href="<?php echo $url_rewrite;?>content/kegiatan">Kegiatan</a></li>
              <li <?php if ($link[1] == 'laporan'){ echo "class='active'";}?>><a href="<?php echo $url_rewrite;?>content/laporan">Laporan</a></li>
            <?php endif ?>
            </ul>
          </div>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <?php if ($_SESSION['level'] == 0): ?>
              <li <?php if ($link[1] == 'beritautama' OR $link[1] == 'beritaterkait' OR $link[1] == 'beritamenteri' OR $link[1] == 'pengumuman' OR $link[1] == 'agenda' OR $link[1] == 'mediasosial'){ echo "class='dropdown active'";} else{ echo "class='dropdown'";}?>>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Publikasi <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu" style="background: white;">
                  <li><a href="<?php echo $url_rewrite;?>content/berita">Berita</a></li>
                  <li><a href="<?php echo $url_rewrite;?>content/pengumuman">Pengumuman</a></li>
                </ul>
              </li>
              <?php endif ?>
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo $url_rewrite;?>static/dist/img/Kemenpora.png" class="img-circle" alt="User Image" style="width: 18px; height: 18px">
                  <span class="hidden-xs"><?php echo $_SESSION['username'];?></span>
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
                      <a href="<?php echo $url_rewrite?>content/edtpengguna" class="btn btn-default btn-flat">Profile</a>
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