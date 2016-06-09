<?php
  include 'config/application.php';
  $path     = ltrim($_SERVER['REQUEST_URI'], '/');
  $elements = explode('/', $path);
  $link     = array_filter($elements);
  if (count($link[1 - config::$root]) == 0){
    $utility->location("home");
  }
  else {
    switch ($link[1 - config::$root]) {
      case 'content':
        include "./isi.php";
      break;
      case 'process':
        include "./aksi.php";
      break;
      case 'logout':
        include "./keluar.php";
      break;
      case 'home':
        if ($_SESSION['username'] != '') {
          $utility->location("content/home");
        }
        else {
          //ganti paramaeter dibawah sesuai dengan jenisnya
          /*
            1 = berita utama
            2 = berita terkait
            3 = berita kementerian
          */
          $arrBerita = $berita->getBerita(array(1,2),4);
          $arrBeritaTerkait = $berita->getBerita(array(2),5);
          $arrBeritaKementerian = $berita->getBerita(array(3),5);

          $arrPengumuman = $berita->getPengumuman();
            
          include "./view/include/homeHead.php";
          include "./view/homeIndex.php";
        }
      break;
      case 'dekon':
        if ($_SESSION['username'] != '') {
          $utility->location("content/home");
        }
        else {
          include "./view/include/homeHead.php";
          include "./view/homeDekon.php";
        }
      break;
      case 'review':
        if ($_SESSION['username'] != '') {
          $utility->location("content/home");
        }
        else {
          include "./view/include/homeHead.php";
          include "./view/homeReview.php";
        }
      break;
      case 'baca-berita':
        if($link[2 - config::$root]!=""){
          $utility->location("content/home");
        } else {
          $arrBerita = $berita->getBerita(array(1,2),1,$link[3 - config::$root]);
          $arrBeritaTerkait = $berita->getBerita(array(1),5);
          $arrBeritaKementerian = $berita->getBerita(array(3),5,array());
          include "./view/include/homeHead.php";
          include "./view/homeRead.php";
        }
        
      break;
      case 'login':
        if ($_SESSION['username'] != '') {
          $utility->location("content/home");
        }
        else {

          include "./view/include/homeHead.php";
          include "./view/homeLogin.php";
        }
      break;
      default:
        $utility->location(".");
      break;
    }
  }
?>
