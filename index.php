<?php
  include 'config/application.php';
  $path     = ltrim($_SERVER['REQUEST_URI'], '/');
  $elements = explode('/', $path);
  $link     = array_filter($elements);
  if (count($link[1]) == 0){
    $utility->location("home");
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
        include "./logout.php";
      break;
      case 'home':
        $view[] = "./view/include/homeHead.php";
        $view[] = "./view/homeIndex.php";
        cekandgo($view, $utility, $home);
      break;
      case 'dekon':
        $view[] = "./view/include/homeHead.php";
        $view[] = "./view/homeDekon.php";
        cekandgo($view, $utility, $home);
      break;
      case 'review':
        $view[] = "./view/include/homeHead.php";
        $view[] = "./view/homeReview.php";
        cekandgo($view, $utility, $home);
      break;
      case 'login':
        $view[] = "./view/include/homeHead.php";
        $view[] = "./view/homeLogin.php";
        cekandgo($view, $utility);
      break;
      default:
        $utility->location(".");
      break;
    }
  }
  function cekandgo($view, $utility, $home=null) {
    if ($_SESSION['username'] != '') {
      $utility->location("content/home");
    }
    else {
      for ($i=0; $i < count($view) ; $i++) { 
        include $view[$i];
      }
    }
  }
?>
