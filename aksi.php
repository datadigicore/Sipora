<?php
  if (count($link[1]) == 0) {
    $utility->location(".");
  }
  else {
    switch ($link[2]) {
      case 'login':
        include "./core/prosesLogin.php";
      break;
      case 'rkakl':
        include "./core/process/prosesRkakl.php";
      break;
      case 'rab':
        include "./core/process/prosesRab.php";
      break;
      case 'user':
        include "./core/process/prosesPengguna.php";
      break;
      case 'report':
        include "./core/process/prosesReport.php";
      break;
      default:
        $utility->location(".");
      break;
    }
  }
?>
