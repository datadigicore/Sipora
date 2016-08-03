<?php
  if ($_SESSION['username'] != '') {
    if (count($link[1 - config::$root]) == 0) {
      $utility->location(".");
    }
    else {
      include './view/include/contentMeta.php';
      include './view/include/contentJavascript.php';
      include './view/include/contentHeader.php';
      switch ($link[2 - config::$root]) {
        case 'home':          
          include "./view/content/contentHome.php";
        break;
        case 'diagram':          
          include "./view/content/contentDiagram.php";
        break;
        case 'anggaran':          
          include "./view/content/contentRkakl.php";
        break;
        case 'kegiatan':          
          include "./view/content/contentRabRkakl.php";
        break;
        case 'kegiatan-rinci':       
          $idrkakl = $link[3 - config::$root];   
          include "./view/content/contentRab.php";
        break;
        case 'kegiatan-tambah':   
          $idrkakl = $link[3 - config::$root];
          include "./view/content/contentRabTambah.php";
        break;
        case 'kegiatan-edit':   
          $idrkakl = $link[4 - config::$root];   
          $idview = $link[3 - config::$root];   
          $getview = $rab->getview($idview);
          include "./view/content/contentRabEdit.php";
        break;
        case 'laporan':          
          include "./view/content/contentReport.php";
        break;
        case 'pengguna':
          if ($_SESSION['level'] == 0) {          
            $kdprog = $rab->getProg();
            $group = $pengguna->getGroup();
            include "./view/content/contentPengguna.php"; }
          else {
            $utility->location("content/home"); }
        break;
        case 'edtpengguna':          
          include "./view/content/contentEditProfile.php";
        break;
        case 'edit_pass':          
          include "./view/content/contentEditPass.php";
        break;
        case 'addpengguna':
          if ($_SESSION['level'] == 0) {
            $group = $pengguna->getGroup();
            include "./view/content/contentPenggunaAdd.php"; }
          else {
            $utility->location("content/home"); }
        break;
        case 'addgroup':
          if ($_SESSION['level'] == 0) {
            $kdprog = $rab->getProg();
            include ('view/content/contentGrupAdd.php'); }
          else {
            $utility->location("content/home"); }
        break;
        case 'triwulan':          
          if ($_SESSION['level'] == 0) {
            include "./view/content/contentTriwulan.php"; }
          else {
            $utility->location("content/home"); }
        break;
        case 'prosentase':
          if ($_SESSION['level'] == 0) {
            include "./view/content/contentProgress.php"; }
          else {
            $utility->location("content/home"); }
        break;
        case 'berita':
          if ($_SESSION['level'] == 0) {

            include "./view/content/contentBerita.php"; }
          else {
            $utility->location("content/home"); }
        break;
        case 'pengumuman':
          if ($_SESSION['level'] == 0) {
            $query = "SELECT isi from pengumuman";
            $result=$db->_fetch_array($query,1);
            $pengumuman = $result[0]['isi'];
            include "./view/content/contentPengumuman.php"; }
          else {
            $utility->location("content/home"); }
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
