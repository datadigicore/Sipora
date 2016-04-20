<?php
  if ($_SESSION['username'] != '') {
    if (count($link[1]) == 0) {
      $utility->location(".");
    }
    else {
      include './view/include/contentMeta.php';
      include './view/include/contentJavascript.php';
      include './view/include/contentHeader.php';
      switch ($link[2]) {
        case 'home':          
          include "./view/content/contentHome.php";
        break;
        case 'anggaran':          
          include "./view/content/contentRkakl.php";
        break;
        case 'kegiatan':          
          include "./view/content/contentRabRkakl.php";
        break;
        case 'kegiatan-rinci':       
          $idrkakl = $link[3];   
          include "./view/content/contentRab.php";
        break;
        case 'kegiatan-tambah':   
          $idrkakl = $link[3];   
          include "./view/content/contentRabTambah.php";
        break;
        case 'laporan':          
          include "./view/content/contentReport.php";
        break;
        case 'pengguna':          
          include "./view/content/contentPengguna.php";
        break;
        case 'edtpengguna':          
          include "./view/content/contentEditProfile.php";
        break;
        case 'addpengguna':          
          include "./view/content/contentPenggunaAdd.php";
        break;
        case 'triwulan':          
          include "./view/content/contentTriwulan.php";
        break;
        default:
          $utility->location("content/home");
        break;
      }
    }
  }
  else {
    $utility->location(".");
  }
  include './view/include/contentFooter.php';
?>
