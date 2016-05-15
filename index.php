<?php
  include 'config/application.php';
  $path     = ltrim($_SERVER['REQUEST_URI'], '/');
  $elements = explode('/', $path);
  $link     = array_filter($elements);
  if (count($link[1]) == 0){
    $utility->location("login");
  }
  else {
    switch ($link[1]) {
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
