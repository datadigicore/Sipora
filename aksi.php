<?php
  if (count($link[1 - config::$root]) == 0) {
    $utility->location(".");
  }
  else {
    switch ($link[2 - config::$root]) {
      case 'login':
        include "./core/prosesLogin.php";
      break;
      case 'anggaran':
        include "./core/process/prosesRkakl.php";
      break;
      case 'kegiatan':
        include "./core/process/prosesRab.php";
      break;
      case 'pengguna':
        include "./core/process/prosesPengguna.php";
      break;
      case 'laporan':
        include "./core/process/prosesReport.php";
      break;
      case 'triwulan':
        include "./core/process/prosesTriwulan.php";
      break;
      case 'berita':
        include "./core/process/prosesBerita.php";
      break;
      default:
        $utility->location(".");
      break;
    }
  }
?>
